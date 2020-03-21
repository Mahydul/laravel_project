<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function save(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->image = $request->image;
        $category->description = $request->description;
        echo $category->save();
    }

    public function list()
    {
        return Category::all();
    }

    /**
     * @param Request $request
     */
    public function update_cat(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        echo $category->save();
    }
}
