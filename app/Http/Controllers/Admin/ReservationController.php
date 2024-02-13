<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.reservations.index');
    }

    public function getAllList(Request $request)
    {
        $data = Reservation::all();
        return DataTables::of($data)
            ->addColumn('action', function ($menu) {
                return '<form deleteReservationsFunction(' . $menu->id . ') action="/admin/reservations/delete/' . $menu->id . '" method="POST" class="d-inline">
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
        $data = Reservation::where('id', $id)->first();
        return response()->json(['data' => $data]);
    }
    public function create()
    {
        return view('admin.reservations.create');
    }

    public function destroy($id)
    {
        try {
            $tables = Reservation::findOrFail($id)->delete();
            $response = [
                'success' => true,
                'data' => $tables,
                'message' => 'Reservation deleted successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'message' => 'An error occurred while deleting reservation.'
            ];
            return response()->json($response, 500);
        }
    }
}
