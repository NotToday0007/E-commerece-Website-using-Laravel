<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Helper\ResponseHelper; // Correct import
use App\Models\TopbarCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryList(): JsonResponse
    {
        $data = Category::all();
        return ResponseHelper::Out('success', $data, 200); // Correct method call
    }

    public function TopbarCategory(): JsonResponse
    {
        $data = TopbarCategory::all();
        return ResponseHelper::Out('success', $data, 200); // Correct method call
    }





}
