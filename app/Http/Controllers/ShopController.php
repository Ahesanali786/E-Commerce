<?php

namespace App\Http\Controllers;

use App\Models\Atribute;
use App\Models\AtributeValue;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Products;
use App\Models\Sub_Category;
use Illuminate\Http\Request;

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
            $products = Products::get();
            return view('website.shop', compact('showCategories', 'showSubCategories', 'products'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function productDetails($id)
    {
        try {
            $productDtails = Products::find($id);
            $variants = AtributeValue::where('product_id', $id)->get();
            $attribute = Atribute::where('product_id', $id)
                ->where('variant_name', 'Colour')
                ->first();
            if (isset($attribute)) {
                $colorValues = AtributeValue::where('product_id', $id)
                    ->where('attributes_id', $attribute->id)
                    ->get();
            } else {
                $colorValues = '';
            }
            $getVeriantsSize = Atribute::where('product_id', $id)
                ->where('variant_name', 'Size')
                ->first();
            if (isset($getVeriantsSize)) {
                $sizeValue = AtributeValue::where('product_id', $id)
                    ->where('attributes_id', $getVeriantsSize->id)
                    ->get();
            } else {
                $sizeValue = '';
            }
            // $products = Products::get();
            $categoryId = $productDtails->sub_category_id;
            $products = Products::where('sub_category_id', $categoryId)->get();
            // dd($products);
            $cartDetails = Cart::get();
            $next = Products::where('id', '>', $productDtails->id)->min('id');
            $previous = Products::where('id', '<', $productDtails->id)->max('id');
            return view('website.products_details', compact('productDtails', 'next', 'previous', 'products', 'cartDetails', 'variants', 'colorValues', 'attribute', 'sizeValue'));
        } catch (\Exception $e) {
            // return redirect()->back()->with('error','This Product Varinats Are not Available');
            dd($e->getMessage());
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
