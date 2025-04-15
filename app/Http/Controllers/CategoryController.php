<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function All_Categorys()
    {
        $allCategory = Category::all();
        return view('category.categoryList', compact('allCategory'));
    }
    public function Create_Update_Category(Request $request, $id = null)
    {
        if ($id) {
            $editCategory = Category::find($id);
            return view('category.addcategory', compact('editCategory'));
        }
        return view('category.addcategory');
    }
    public function Store_Category(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Please Enter Your Product Name'
        ]);

        try {
            $existingCategory = Category::where('name', $request->name)->first();
            // dd($existingCategory);
            if ($existingCategory) {
                return redirect()->back()->with('error', 'Category Allready exist');
            }
            // dd($request->all());
            $category = new Category();
            $category->name = $request->name;
            $category->status = $request->status ? '1' : '0';
            $category->save();

            return redirect()->route('all.category')->with('success', 'Category added successfully');
        } catch (\Exception  $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function Update_Category(Request $request, $id = null)
    {
        try {
            // dd($request->all());
            $updateCategory = Category::find($id);
            $updateCategory->name = $request->name;
            $updateCategory->status = $request->status ? '1' : '0' ;
            // dd($updateCategory);
            $updateCategory->save();

            return redirect()->route('all.category')->with('success', 'Category Update successfully');
        } catch (\Exception  $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function Destroye_Category($id)
    {
        $categoryDelete = Category::find($id);
        $categoryDelete->delete();
        return redirect()->route('all.category')->with('info', 'Category Delete successfully');
    }
}
