<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;

class ContactsController extends Controller
{
    public function index(){
        $contacts = ContactUs::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function deleteContacts(Request $request){

        ContactUs::find($request->id)->delete();

        return response()->json([
            'data' => 1
        ], 200);
    }
}
