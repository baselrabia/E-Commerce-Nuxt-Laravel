<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\categoryResource;
use App\Models\Category;

class categoryController extends Controller
{
    public function index(){

        return categoryResource::collection(
            Category::with('children')->parents()->ordered()->get()
        );
    }
}
