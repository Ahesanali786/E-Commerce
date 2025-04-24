<?php

namespace App\Http\Controllers;

use App\Models\Atribute;
use App\Models\AtributeValue;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Products;
use App\Models\Review;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function index()
    {
        try {
            $topProducts = Products::take(3)->get();
            $products = Products::get();
            return view('website.index', compact('topProducts', 'products'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function showCategories()
    {
        try {
            $showCategories = Category::get();
            $showSubCategories = Sub_Category::get();
            $products = Products::with('review')->paginate(6);
            // dd($products);
            return view('website.shop', compact('showCategories', 'showSubCategories', 'products'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function productDetails(Request $request)
    {
        try {
            $id = $request->query('product_id');
            $decodedProductId = '';
            try {
                $decodedProductId = Crypt::decrypt($id);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Product not found!');
            }
            if (!$decodedProductId) {
                return redirect()->back()->with('error', 'Invalid product ID');
            }

            $productDetails = Products::findOrFail($decodedProductId);

            // Get all variants for the product
            $variants = AtributeValue::where('product_id', $decodedProductId)->get();

            // Get Color attributes
            $attribute = Atribute::where('product_id', $decodedProductId)
                ->where('variant_name', 'Colour')
                ->first();

            $colorValues = $attribute
                ? AtributeValue::where('product_id', $decodedProductId)
                ->where('attributes_id', $attribute->id)
                ->get()
                : collect();

            // Get Size attributes
            $sizeAttribute = Atribute::where('product_id', $decodedProductId)
                ->where('variant_name', 'Size')
                ->first();

            $sizeValue = $sizeAttribute
                ? AtributeValue::where('product_id', $decodedProductId)
                ->where('attributes_id', $sizeAttribute->id)
                ->get()
                : collect();

            // Related products
            $categoryId = $productDetails->sub_category_id;
            $products = Products::with('review')
                ->where('sub_category_id', $categoryId)
                ->where('id', '!=', $decodedProductId)
                ->get();

            // Reviews
            $reviewProducts = Products::with('review')->where('id', $decodedProductId)->get();
            $productReviews = Review::where('product_id', $decodedProductId)->get();

            // Cart
            $cartDetails = Cart::all();

            // Next and previous navigation
            $nextProduct = Products::where('id', '>', $productDetails->id)->min('id');
            $previousProduct = Products::where('id', '<', $productDetails->id)->max('id');
            $next = $nextProduct ? Products::find($nextProduct) : null;
            $previous = $previousProduct ? Products::find($previousProduct) : null;

            return view('website.products_details', compact(
                'productDetails',
                'next',
                'previous',
                'products',
                'cartDetails',
                'variants',
                'colorValues',
                'attribute',
                'sizeValue',
                'productReviews',
                'reviewProducts'
            ));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Please Give Product Review First');
        } catch (\Exception $e) {
            Log::error('Product detail error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function about()
    {
        return view('website.about');
    }

    public function getvariantsproducts($id)
    {
        try {
            $variants = AtributeValue::find($id);
            // $variant = AtributeValue::where('id',$id)->first();
            $products = Products::get();
            $cartDetails = Cart::get();
            $next = Products::where('id', '>', $variants->id)->min('id');
            $previous = Products::where('id', '<', $variants->id)->max('id');
            return view('website.productveriants', compact('next', 'previous', 'products', 'cartDetails', 'variants'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
