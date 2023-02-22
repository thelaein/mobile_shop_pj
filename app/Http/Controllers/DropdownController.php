<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryBrandModelRelationship;
use Illuminate\Http\JsonResponse;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use function Ramsey\Collection\add;
use Illuminate\Support\Facades\DB;

class DropdownController extends Controller
{
    public function fetchModels(Request $request)
    {
        $category_id = $request->category_id;
        $brand_id = $request->brand_id;
        $data = DB::table('category_brand_model_relationships')
            ->join('product_models', 'category_brand_model_relationships.model_id', '=', 'product_models.id')
            ->select('category_brand_model_relationships.*','product_models.name')
            ->where('category_id', $category_id)
            ->where('brand_id', $brand_id)
            ->get();
        return response()->json(['status_code' => '200', 'data' => $data]);
    }
}
