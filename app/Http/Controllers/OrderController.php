<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Helper\Helper;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DateTime;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'status' => 'required|in:seed,startup',
            'startup_name' => 'required|string',
            'startup_equity' => 'required|numeric|min:0',
            'startup_valuation' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->status = $request->status;
        $order->startup_name = $request->startup_name;
        $order->startup_equity = $request->startup_equity;
        $order->startup_valuation = $request->startup_valuation;
        $order->amount = $request->amount;
        $order->save();

        // Update the user's phone number
        $user = User::find($request->user_id);
        $user->mobile_number = $request->phone;
        $user->save();

        return response()->json(
            [
                'message' => 'Order created successfully',
                'order' => $order,
            ],
            201,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        // Fetch orders for the specific user
        $orders = Order::where('user_id', $user_id)->select('name', 'email', 'phone', 'status', 'startup_name', 'startup_equity', 'startup_valuation', 'amount')->get();

        // Check if the user has orders
        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user.'], 404);
        }

        // Return the orders as a JSON response
        return response()->json(['orders' => $orders]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
