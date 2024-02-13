<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


class CategoryViewController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.categories.index');
    }

    public function getAllList(Request $request)
    {
        $categories = Category::all();
       // dd($categories);
        return response()->json(['data' => $categories]);
    }

    public function getDetails(Request $request, $id)
    {
        $categories = Category::where('id', $id)->first();
        return response()->json(['data' => $categories]);
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'name.required' => 'The name field is required.',
                'description.required' => 'The description field is required.',
                'image.required' => 'The image field is required.',
                'image.image' => 'The image must be an image file.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'image.max' => 'The image may not be greater than 2048 kilobytes.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            $image = $request->file('image')->store('/public/categories');

            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image
            ]);

            $response = [
                'success' => true,
                'data' => $category,
                'message' => 'Category create successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'An error occurred while createing category.'
            ];
            return response()->json($response, 500);
        }
    }
    public function edit($id)
    {
        return view('admin.categories.edit', array('id' => $id));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'required|string',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()->all(),
                ], 422);
            }
            $category = Category::findOrFail($id);
            if ($request->hasFile('image')) {
                if ($category->image) {
                    Storage::delete($category->image);
                }
                $category->image = $request->file('image')->store('/public/categories');
            }

            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            $response = [
                'success' => true,
                'data' => $category,
                'message' => 'Category updated successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'message' => 'An error occurred while updating category.'
            ];
            return response()->json($response, 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id)->delete();
            if ($category->image) {
                Storage::delete($category->image);
            }
            $response = [
                'success' => true,
                'data' => $category,
                'message' => 'Category deleted successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'message' => 'An error occurred while deleting category.'
            ];
            return response()->json($response, 500);
        }
    }

}
