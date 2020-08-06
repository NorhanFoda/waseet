<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Classes\SendEmail;
use App\Classes\Verify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Resources\Roles\RolesResource;
use App\Http\Requests\ApiUserRequest;
use App\Http\Resources\Register\RegisterResource;
use App\Models\EduLevel;
use App\Models\EduType;
use App\Models\Material;
use App\Models\Nationality;
use App\Models\Country;
use App\Models\City;
use App\Models\Document;
use App\Models\Image;
use App\Models\Stage;
use App\Classes\Upload;
use Auth;
use DB;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'verify', 'resendCode', 'getRoles', 'getFromData']]);
    }

    //------------------------------------------------Get registeration roles --------------------------------------------------------//

    public function getRoles(){
        $roles = DB::table('roles')->where('name', '!=', 'admin')->get();
        return response()->json([
            'roles' => RolesResource::collection($roles),
            'visitor' => trans('web.visitor'),
        ], 200);
    }

    //------------------------------------------------ Get registeration roles end --------------------------------------------------------//

    //---------------------------------------------------- Get registeration form data ------------------------------------------------------------------//

    public function getFromData($role){
        //Student
        if($role == 2){
            return response()->json([
                'stages' => RegisterResource::collection(Stage::all()),
            ], 200);
        }

        //Direct/Online teacher
        else if($role == 3 || $role == 4){
            return response()->json([
                'edu_levels' => RegisterResource::collection(EduLevel::all()),
                'materials' => RegisterResource::collection(Material::all()),
                'nationalities' => RegisterResource::collection(Nationality::all()),
                'countries' => RegisterResource::collection(Country::all()),
                'cities' => RegisterResource::collection(City::all()),
            ], 200);
        }

        //Organization
        else if($role == 5){
            return response()->json([
                'edu_types' => RegisterResource::collection(EduType::all()),
                'countries' => RegisterResource::collection(Country::all()),
                'cities' => RegisterResource::collection(City::all()),
            ], 200);
        }

        //Job seeker
        else if($role == 6){
            return response()->json([
                'countries' => RegisterResource::collection(Country::all()),
                'cities' => RegisterResource::collection(City::all()),
            ], 200);
        }
    }

    //---------------------------------------------------- Get registeration form data end --------------------------------------------------------------//

    //--------------------------------- store user data and send verification email start ---------------------------------------------//
    public function register(ApiUserRequest $request){  

        $old = User::where('email', $request->email)->first();

        if($old != null){
            if($old->is_verified == 0){
                if($old->image != null){
                    $removed = Upload::deleteImage($old->image->path);
                    if($removed){
                        $old->delete();
                    }
                    else{
                        return response()->json([
                            'error' => trans('web.error')
                        ], 404);
                    }
                }
                else{
                    $old->delete();
                }
            }
            else{
                return response()->json([
                    'error' => trans('web.email_exsit'),
                ], 404);
            }
        }

        $user = User::create($request->all());
        $user->update(['password' => Hash::make($request->password), 'api_token' => Str::random(191)]);
        if($request->role_id != 'visitor'){
            $user->assignRole(DB::table('roles')->find($request->role_id)->name);
        }

        if($request->role_id == 3 || $request->role_id == 4){
            foreach($request->material_ids as $id){
                $user->materials()->attach($id);
            }

        }

        if($request->role_id == 6){
            $image_url = Upload::uploadPDF($request->cv);
            $cv = Document::create([
                'path' => $image_url,
                'doucmentRef_id' => $user->id,
                'doucmentRef_type' => 'App\User',
            ]);
            $user->document()->save($cv);
        }

        if($request->has('image')){            

            $image_url = Upload::uploadImage($request->image);
            $image = Image::create([
                'path' => $image_url,
                'imageRef_id' => $user->id,
                'imageRef_type' => 'App\User'
            ]);
            $user->image()->save($image);
        }

        $code = $this->createVerificationCode();
        $user->update(['code' => $code]);
        $email = $user->email;

        return $this->sendEmail($request->email, $user->code);   
    }

    //-------------------------------------------------------- store user data end ---------------------------------------------------//

    //-------------------------------------------------- send verification code start ------------------------------------------------//

    public function sendEmail($email, $code){
        if(!$this->validateEmail($email)){
            return response()->json([
                'error' => trans('api.email_not_found'),
            ], 404);
        }

        SendEmail::sendVerificationCode($code, $email);

        return response()->json([
            'success' => trans('api.verification_code_sent'),
        ], 200);
    }

    //-------------------------------------------------- send verification code end -------------------------------------------------//

    //----------------------------------------------- resend verification code start -------------------------------------------------//
    public function resendCode(Request $request){
        $this->validate($request, ['email' => 'required']);

        $code = $this->createVerificationCode();
        $user = User::where('email', $request->email)->first();

        if($user == null){
            return response()->json([
                'error' => trans('api.email_not_found'),
            ], 400);
        }
        
        if($user->is_verified == 0){
            $user->update(['code' => $code]);
            return $this->sendEmail($request->email, $code);
        }
        else{
            return response()->json([
                'error' => trans('api.email_is_verified_before'),
            ], 400);
        }
    }
    //----------------------------------------------- resend verification code end -------------------------------------------------//


    //---------------------------------------------- verify user email start --------------------------------------------------------//
    public function verify(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'code' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        $verified = Verify::verifyEmail($user, $request->code);

        if($verified){
            return response()->json([
                'data' => Auth::loginUsingId($user->id, true)
            ], 200);
        }
        
        return response()->json([
            'error' => trans('api.invalid_code'),
        ], 400);
    }
    //---------------------------------------------- verify user email end ----------------------------------------------------------//



    private function createVerificationCode(){
        return rand ( 1000 , 9999 );
    }

    public function validateEmail($email){
        return !!User::where('email', $email)->first();
    }
}
