<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

    public function lists()
    {
        $categoryList = Category::getCategory();
        return response()->json($categoryList);
    }
}
