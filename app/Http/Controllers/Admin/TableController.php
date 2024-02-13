<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TableController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.tables.index');
    }
    public function getAllList()
    {
        $table = Table::select('*')->get();
        return DataTables::of($table)
            ->addColumn('action', function ($menu) {
                return '<a href="/admin/table/edit/' . $menu->id . '" class="btn btn-primary">Edit</a>
                        <form deleteTableFunction(' . $menu->id . ') action="/admin/table/delete/' . $menu->id . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDetails(Request $request, $id)
    {
        $tables = Table::where('id', $id)->first();
        return response()->json(['data' => $tables]);
    }
    public function create()
    {
        return view('admin.tables.create');
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'guest_number' => 'required|string',
                'location' => 'required|string',
            ], [
                'name.required' => 'The name field is required.',
                'guest_number.required' => 'The guest_number field is required.',
                'location.required' => 'The location field is required.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            $tables = Table::create([
                'name' => $request->name,
                'guest_number' => $request->guest_number,
                'status' => @$request->status ?? 0,
                'location' => $request->location,
            ]);

            $response = [
                'success' => true,
                'data' => $tables,
                'message' => 'Table create successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'An error occurred while creating Table.'
            ];
            return response()->json($response, 500);
        }
    }
    public function edit($id)
    {
        return view('admin.tables.edit', array('id' => $id));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'guest_number' => 'required|string',
                'location' => 'required|string',
            ], [
                'name.required' => 'The name field is required.',
                'guest_number.required' => 'The guest_number field is required.',
                'location.required' => 'The location field is required.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()->all(),
                ], 422);
            }
            $tables = Table::findOrFail($id);
            $tables->name = $request->name;
            $tables->guest_number = $request->guest_number;
            $tables->status = @$request->status ?? 0;
            $tables->location = $request->location;
            $tables->save();

            $response = [
                'success' => true,
                'data' => $tables,
                'message' => 'Table updated successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'message' => 'An error occurred while updating Table.'
            ];
            return response()->json($response, 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tables = Table::findOrFail($id)->delete();
            $response = [
                'success' => true,
                'data' => $tables,
                'message' => 'Table deleted successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'message' => 'An error occurred while deleting Table.'
            ];
            return response()->json($response, 500);
        }
    }
}
