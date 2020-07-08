<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Bags\BagCategoryResource;
use App\Http\Resources\Bags\BagResource;
use App\Http\Resources\Bags\BagDetailsResource;
use App\Models\BagCategory;
use App\Models\Bag;

class BagCategoryController extends Controller
{
    public function index(){
        return response()->json([
            'categories' => BagCategoryResource::collection(BagCategory::all()),
        ], 200);
    }

    public function getCategoryBags(Request $request){
        $this->validate($request, ['category_id' => 'required']);

        $cat = BagCategory::find($request->category_id);

        return response()->json([
            'bags' => BagResource::collection($cat->bags),
        ], 200);
    }

    public function getBagDetails(Request $request){
        $this->validate($request, ['bag_id' => 'required']);

        $bag = Bag::find($request->bag_id);
        $cat = BagCategory::find($bag->category->id);

        return response()->json([
            'details' => new BagDetailsResource($bag),
            'similar_bags' => BagResource::collection($cat->bags->where('id', '!=', $bag->id)),
        ], 200);
    }
}
