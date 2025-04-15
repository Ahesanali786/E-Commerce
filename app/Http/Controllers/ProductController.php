<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function All_Products()
    {
        $products = Products::get();
        return view('product.product_list', compact('products'));
    }
    public function CreateProduct(Request $request)
    {
        $Category = Category::all();
        return view('product.add&update', compact('Category'));
    }
    public function showSubCategorys(Request $request)
    {
        $subCategorys = Sub_Category::where('category_id', $request->Category_id)->get();
        return response()->json($subCategorys);
    }
    public function Store_Product(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required'
            ], [
                'name.required' => 'Please Enter Your Product Name'
            ]);


            $product = new Products();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->sub_category_id = $request->sub_category_id;
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product_image'), $imageName);
                $product->image = $imageName;
            }
            $product->save();

            return redirect()->route('all.products')->with('success', 'Product Added Successfully!');
        } catch (\Exception  $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function UpdateProducts($id)
    {
        $products =  Products::with('subCategory')->find($id);
        $Category = Category::all();
        $subCategorys = Sub_Category::where('category_id', $products->subCategory->category->id)->get();
        return view('product.update', compact('Category', 'products', 'subCategorys'));
    }
    public function UpdateSubCategorys(Request $request)
    {
        $subCategorys = Sub_Category::where('category_id', $request->Category_id)->get();
        return response()->json($subCategorys);
    }
    public function Update_Product(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Please Enter Your Product Name'
        ]);

        try {
            // dd($request->all());
            $product = Products::find($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->sub_category_id = $request->sub_category_id;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $existingImagePath = public_path('Product_image/' . $product->image);
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Product_image'), $imageName);
                $product->image = $imageName;
            }
            $product->save();

            return redirect()->route('all.products')->with('success', 'Product Update Successfully');
        } catch (\Exception  $e) {
            dump($e->getMessage());
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function Destroye_Product($id)
    {
        $deleteProduct = Products::find($id);
        $deleteProduct->delete();
        return redirect()->route('all.products')->with('success', 'Product deleted Successfully');
    }
    public function CategoryReletedProducts($category_id)
    {
        $subctrg = Sub_Category::where('category_id', $category_id)->pluck('id');
        $products = Products::whereIn('sub_category_id', $subctrg)->get();
        $showCategories = Category::get();
        $subCategorys = Sub_Category::where('category_id', $category_id)->get();
        // dd($subCategorys);

        return view('website.show_product', compact('products','subctrg', 'showCategories', 'subCategorys'));
    }
}
