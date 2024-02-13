<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }
    
    public function getAllList(Request $request)
    {
        $categories = Category::all();
        return response()->json(['data' => $categories]);
    }

    public function show($id)
    {
        return view('categories.show', compact('id'));
    }

    public function getDetails(Request $request, $id)
    {
        $categories = Category::where('id', $id)->first();
        return response()->json(['data' => $categories]);
    }
}
