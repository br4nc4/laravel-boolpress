<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function posts($id){
        $category = Category::findOrFail($id);

        return $category->posts;
    }
}
