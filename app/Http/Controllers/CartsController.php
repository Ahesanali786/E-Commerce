<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function addToCart(Request $request)
    {
        // // dd($request->all());
        // $request->validate([
        //     'selected_colour[]' => 'required',
        //     'selected_size[]' => 'required'
        // ], [
        //     'selected_colour[].required' => 'Please select a Colour.',
        //     'selected_size[].required' => 'Please select a Size.'
        // ]);
        try {
            if (Auth::check()) {

                $addCart = new Cart();
                $addCart->qty = $request->qty;
                $addCart->product_id = $request->product_id;
                $productsVariants = [];
                foreach ($request->selected_colour as $key => $colour) {
                    $productsVariants[] = [
                        "product_colour" => $colour,
                        "product_size" => $request->selected_size[$key]
                    ];
                }
                $addCart->products_variants = json_encode($productsVariants);
                $addCart->user_id = Auth::id();
                $addCart->save();

                return redirect()->back()->with('success', 'Product Add to Cart successfully');
            } else {
                return redirect()->route('login')->with('info', 'Sir Please Login First');
            }
        } catch (\Exception  $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function cartDetails()
    {
        $userId = Auth::id();
        $cartDetails = Cart::where('user_id', $userId)->get();
        // dd($cartDetails);
        return view('website.cart', compact('cartDetails'));
    }
    public function DeleteCartProduct($id)
    {
        $delete = Cart::find($id);

        if ($delete->id) {
            $deleteItem = $delete->delete();
        } else {
            return response()->json(['error' => 'id is not available']);
        }
        return response()->json(['success' => 'item deleted successfully!']);
    }
    public function updateToCart(Request $request, $id)
    {
        try {
            if (Auth::check()) {

                $addCart = Cart::find($id);
                $addCart->qty = $request->qty;
                $addCart->save();

                return redirect()->route('product.cart')->with('success', 'Product update to Cart successfully');
            } else {
                return redirect()->route('login')->with('info', 'Sir Please Login First');
            }
        } catch (\Exception  $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function order()
    {
        return view('website.chackout');
    }
    public function confirmationOrder()
    {
        return view('website.order-confirmation');
    }
    public function updateAllCart(Request $request)
    {
        dd($request->all());
        try {
            if (!Auth::check()) {
                return redirect()->route('login')->with('info', 'Please login first');
            }

            foreach ($request->input('ids') as $id) {
                $cartItem = Cart::find($id);

                if ($cartItem && isset($request->qty[$id])) {
                    $cartItem->qty = $request->qty[$id];
                    $cartItem->save();
                }
            }

            return redirect()->route('product.cart')->with('success', 'Cart updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

}
