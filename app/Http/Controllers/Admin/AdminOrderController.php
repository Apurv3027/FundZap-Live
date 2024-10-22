<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DateTime;
use App\Helper\helper;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $orders = Order::all();
                // dd($orders->toArray());
                return DataTables::of($orders)
                    ->addIndexColumn()
                    ->addColumn('action', function ($order) {
                        $editLink = '';
                        $viewLink = URL::to('/') . '/admin/orders/' . $order->user_id . '/' . $order->id;

                        return Helper::Action($editLink, $order->user_id, $viewLink);
                    })
                    ->editColumn('phone', function ($order) {
                        return $order->phone ?: '-';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        return view('admin.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id, $id)
    {
        // Fetch the order by its ID
        $order = Order::where('user_id', $user_id)->where('id', $id)->first();

        // Check if the order exists
        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Order not found');
        }

        // Return the view with order details
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
