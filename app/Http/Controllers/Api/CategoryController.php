<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ResponseJson;

class CategoryController extends Controller
{

    use ResponseJson;

    public function lists()
    {
        $categoryList = Category::getCategory();
        return $this->responseJson(0, '', $categoryList);
    }
}
