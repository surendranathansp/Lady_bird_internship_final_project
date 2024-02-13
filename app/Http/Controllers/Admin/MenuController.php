<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menus.index');
    }

    public function getAllList()
    {
        $menus = Menu::select('id', 'name', 'description','image', 'created_at', 'updated_at')->get();
        return DataTables::of($menus)
            ->addColumn('action', function ($menu) {
                return '<a href="/admin/menus/edit/' . $menu->id . '" class="btn btn-primary">Edit</a>
                        <form deleteMenuFunction(' . $menu->id . ') action="/admin/menus/delete/' . $menu->id . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getDetails($id)
    {
        $data = Menu::where('id', $id)->first();
        return response()->json(['data' => $data]);
    }

    public function create()
    {
        return view('admin.menus.create');
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'required|string',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'price' => 'required|numeric'
            ], [
                'name.required' => 'The name field is required.',
                'description.required' => 'The description field is required.',
                // 'image.required' => 'The image field is required.',
                // 'image.image' => 'The image must be an image file.',
                // 'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                // 'image.max' => 'The image may not be greater than 2048 kilobytes.',
                'price.required' => 'The price field is required.',
                'price.numeric' => 'The price must be a number.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            $image = $request->file('image')->store('public/menus');

            $menu = Menu::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image,
                'price' => $request->price
            ]);

            $response = [
                'success' => true,
                'data' => $menu,
                'message' => 'Menu create successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'An error occurred while createing menu.'
            ];
            return response()->json($response, 500);
        }
    }
    public function edit($id)
    {
        return view('admin.menus.edit', array('id' => $id));
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
            $menu = Menu::findOrFail($id);
            if ($request->hasFile('image')) {
                if ($menu->image) {
                    Storage::delete($menu->image);
                }
                $menu->image = $request->file('image')->store('public/menus');
            }

            $menu->name = $request->name;
            $menu->description = $request->description;
            $menu->save();

            $response = [
                'success' => true,
                'data' => $menu,
                'message' => 'Menu updated successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'message' => 'An error occurred while updating menu.'
            ];
            return response()->json($response, 500);
        }

    }
    public function destroy(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);
            if ($menu->image) {
                Storage::delete($menu->image);
            }
            $menu->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Menu deleted successfully'
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting Menu.'
            ], 500);
        }
    }

}