<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;
use Yajra\DataTables\Facades\DataTables;

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
    public function shwouserOrders(Request $request)
    {
        // $userId = Auth::id();
        // $userOrders = OrderDetails::where('user_id', $userId)->get();
        // // dd($userOrders);
        // return view('website.user-accounts.user-orderdatails', compact('userOrders'));

        if ($request->ajax()) {
            $userId = Auth::id();
            $userOrders = OrderDetails::where('user_id', $userId)->get();

            return DataTables::of($userOrders)
                ->addIndexColumn()
                ->addColumn('select', function ($row) {
                    return '<input type="checkbox" name="order_ids[]" value="' . $row->id . '">';
                })
                ->addColumn('Order_id', function ($row) {
                    return $row->order->id + 1000;
                })
                ->addColumn('name', function ($row) {
                    return optional($row->order->address)->name;
                })
                ->addColumn('phone', function ($row) {
                    return optional($row->order->address)->phone_no;
                })
                ->addColumn('product_name', function ($row) {
                    return $row->product->name ?? 'N/A';
                })
                ->addColumn('payment_method', function ($row) {
                    return $row->order->payment_method ?? 'N/A';
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d M Y - h:i A');
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . url('order/product/confirmation/' . $row->order_id) . '">
                                <div class="list-icon-function view-icon">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                </div>
                            </a>';
                })
                ->rawColumns(['select', 'action'])
                ->make(true);
        }

        return view('website.user-accounts.user-orderdatails');
    }

    public function showUserAccounts()
    {
        return view('website.user-accounts.user-accounts');
    }
    public function showUserAddress()
    {
        return view('website.user-accounts.user-address');
    }
    public function ShowUserOrders()
    {
        $userId = Auth::id();
        $showMyOrders = OrderDetails::where('user_id', $userId)->get();
        foreach ($showMyOrders as $order) {
            $order->user_review = Review::where('user_id', $userId)
                ->where('orderDetails_id', $order->id)
                ->first();
        }
        return view('website.users-orders', compact('showMyOrders'));
    }

    /**
     * sending the product review
     */
    public function sendProductReview(Request $request)
    {
        try {

            $id = $request->query('order_id');
            // in blade file passed Order id to decryptstring and show url
            $decodedId = '';
            try {
                $decodedId = Crypt::decryptString($id);
            } catch (\Exception $e) {
                return redirect()->route('my.orders')->with('error', 'order not found!');
            }
            $reviewProduct = OrderDetails::with('product')->find($decodedId);
            return view('website.review', compact('reviewProduct'));
        } catch (\Exception $e) {
            return redirect()->route('my.orders')->with('error', 'order not found!');
        }
    }
}
