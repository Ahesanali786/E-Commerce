<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessOrderJob;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orderDetails()
    {
        /*
            get loggedin user id
        */
        $userId = Auth::id();
        /**
         * get address with loggeding user
         */
        $addresses = Address::where('user_id', $userId)->get();
        /**
         * get cart item with loggeding user
         */
        $orderDetails = Cart::where('user_id', $userId)->get();
        if ($orderDetails->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Please Add Cart Your Products!']);
        }
        return view('website.chackout', compact('orderDetails', 'addresses'));
    }

    public function placeorder(Request $request)
    {
        // Validate the payment method
        $request->validate([
            'checkout_payment_method' => 'required'
        ], [
            'checkout_payment_method.required' => 'Please select a payment method.'
        ]);

        try {
            // Initialize address ID
            $addressId = null;

            // Check if new address fields are provided
            if ($request->has(['name', 'phone', 'zip', 'state', 'city', 'address', 'locality', 'landmark'])) {
                // Save new address
                $address = new Address();
                $address->name = $request->name;
                $address->user_id = Auth::id();
                $address->phone_no = $request->phone;
                $address->pincode = $request->zip;
                $address->state = $request->state;
                $address->city = $request->city;
                $address->house_no = $request->address;
                $address->area = $request->locality;
                $address->landmark = $request->landmark;
                $address->save();

                $addressId = $address->id; // Save the address ID for linking with the order
            } else {
                // If no address provided, check for existing address ID
                if (!$request->has('address_id')) {
                    return redirect()->back()->withErrors(['address_id' => 'No address information provided.']);
                }
                $addressId = $request->address_id; // Use existing address
            }

            // Check if the cart is empty
            $cartItems = Cart::where('user_id', Auth::id())->get();
            if ($cartItems->isEmpty()) {
                return redirect()->route('product.cart')->withErrors(['error' => 'Your cart is empty. Cannot place order again.']);
            }

            // Create a new order entry
            $order = new Order();
            $order->user_id = Auth::id();
            $order->address_id = $addressId;
            $order->payment_method = $request->checkout_payment_method;
            $order->save();

            // Handle order details if present
            if (isset($request->orderDetails)) {
                $total = 0; // Initialize total

                // Loop through each order detail (products list)
                foreach ($request->orderDetails as $index => $products) {
                    $productDetails = json_decode($products); // Decode JSON product data

                    foreach ($productDetails as $product) {
                        // Calculate subtotal for current product
                        $subtotal = $product->qty * $product->product->price;
                        $total += $subtotal;

                        OrderDetails::create([
                            'qty' => (int) $product->qty,
                            'product_id' => $product->product_id,
                            'product_price' => $product->product->price,
                            'total' => $subtotal,
                            'order_id' => $order->id,
                            'user_id' => Auth::id(),
                            'products_variants' => $product->products_variants,
                        ]);
                    }
                }

                // Dispatch job for background processing
                dispatch(new ProcessOrderJob($order));

                // Clear user's cart after successful order
                Cart::where('user_id', Auth::id())->delete();

                // Redirect with success message
                return redirect()->route('details.order.products', $order->id)
                    ->with('success', 'Order placed successfully!');
            } else {
                // No order details were provided
                return redirect()->back()->with('error', 'Order was not placed due to missing order details.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
