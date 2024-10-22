<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\User;
use App\Models\News;
use App\Models\Portfolio;
use App\Models\Startup;
use App\Models\VentureCapital;
use App\Models\Order;

class AdminHomeController extends Controller
{
    public function index(){
        // Get the total number of users
        $totalUsers = User::count();

        // Get the total number of news
        $totalNews = News::count();

        // Get the total number of portfolios
        $totalPortfolio = Portfolio::count();

        // Get the total number of startups
        $totalStartup = Startup::count();

        // Get the total number of venture capital
        $totalVentureCapital = VentureCapital::count();

        // Get the total number of orders
        $totalOrders = Order::count();

        return view('admin.dashboard.home', compact('totalUsers', 'totalNews', 'totalPortfolio', 'totalStartup', 'totalVentureCapital', 'totalOrders'));
    }

    public function notFound(Request $request){
        return view('admin.errors.404');
    }

    public function exceptions(Request $request){
        return view('admin.errors.500');
    }

    public function unauthorized(Request $request){
        return view('admin.errors.401');
    }
}
