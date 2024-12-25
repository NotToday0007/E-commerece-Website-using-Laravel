<?php

namespace App\Http\Controllers;
use App\Models\ProductSlider;
use App\Models\Product;
use App\Helper\ResponseHelper; // Correct import
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function ProductSliders():JsonResponse{
    $data= ProductSlider::all();
    return ResponseHelper::out('success',$data,200);
   }

public function listProductbyRemarks(Request $request):JsonResponse{

$data = Product::where('remark',$request->remark)->with ('brand','category')->get();
return ResponseHelper::out('success',$data,200);
}





}
