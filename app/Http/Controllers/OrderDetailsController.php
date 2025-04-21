<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailsController extends Controller
{
    public function showOrderDetails($id)
    {
        $order = Order::find($id);
        $orderDetails = OrderDetails::where('order_id', $id)->get();
        // dd($orderDetails);
        return view('website.order-confirmation', compact('orderDetails', 'order'));
    }

    public function shwouserDashboard()
    {
        return view('website.user-accounts.dashboard');
    }
    public function shwouserOrders()
    {
        $userId = Auth::id();
        $userOrders = OrderDetails::where('user_id', $userId)->get();
        // dd($userOrders);
        return view('website.user-accounts.user-orderdatails', compact('userOrders'));
    }
    public function showUserAccounts()
    {
        return view('website.user-accounts.user-accounts');
    }
    public function showUserAddress()
    {
        return view('website.user-accounts.user-address');
    }

}
