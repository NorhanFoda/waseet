<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Bags\BagCategoryResource;
use App\Http\Resources\Bags\BagResource;
use App\Http\Resources\Bags\BagDetailsResource;
use App\Models\BagCategory;
use App\Models\Bag;
use Auth;

class BagCategoryController extends Controller
{
    public function index(){
        return response()->json([
            'categories' => BagCategoryResource::collection(BagCategory::all()),
        ], 200);
    }

    public function getCategoryBags($id){

        $cat = BagCategory::find($id);

        if($cat == null){
            return response()->json([
                'error' => trans('api.cat_not_foung'),
            ], 400);    
        }

        return response()->json([
            'bags' => BagResource::collection($cat->bags),
        ], 200);
    }

    public function getBagDetails($id){
        
        $bag = Bag::find($id);
        $cat = BagCategory::find($bag->category->id);

        if($bag == null){
            return response()->json([
                'error' => trans('api.bag_not_foung'),
            ], 400);    
        }

        if($cat == null){
            return response()->json([
                'error' => trans('api.cat_not_foung'),
            ], 400);    
        }

        return response()->json([
            'details' => new BagDetailsResource($bag),
            'similar_bags' => BagResource::collection($cat->bags->where('id', '!=', $bag->id)),
        ], 200);
    }

    public function getAllBags(){
        if(count(Bag::all()) == 0){
            return response()->json([
                'success' => trans('api.bags_empty'),
            ], 200);    
        }

        return response()->json([
            'bags' => BagResource::collection(Bag::all()),
        ], 200);
    }
}
