<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{

    public function lists()
    {
        $categoryList = Category::getCategory();
        return response()->json($categoryList);
    }
}
