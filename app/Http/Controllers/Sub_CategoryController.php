<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub_Category;
use Illuminate\Http\Request;

class Sub_CategoryController extends Controller
{
    public function All_SubCategorys()
    {
        $subCategory = Sub_Category::with('Category')->get();
        // dd($subCategory);
        return view('subcategory.subcategoryList', compact('subCategory'));
    }
    public function CreateSubCategory(Request $request)
    {
        $Category = Category::all();
        return view('subcategory.add_subcategory', compact("Category"));
    }

    public function Store_SubCategory(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Please Enter Your Product Name'
        ]);

        try {

            $existingSubCategory = Sub_Category::where('name', $request->name)->first();

            if ($existingSubCategory) {
                return redirect()->back()->with('error', 'Sub Category Allready exist');
            }


            $subCategory = new Sub_Category();
            $subCategory->name = $request->name;
            $subCategory->status = $request->status ? '1' : '0';
            $subCategory->category_id = $request->category_id;
            $subCategory->save();

            return redirect()->route('all.sub.category')->with('success', 'sub category added successfully!');
        } catch (\Exception  $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function UpdateSubCategory($id)
    {
        $subCategory = Sub_Category::with('Category')->find($id);
        $Category = Category::all();
        // dd($subCategory);
        return view('subcategory.updateSubCategory', compact('subCategory','Category'));
    }
    public function Update_SubCategory(Request $request, $id)
    {
        try {

            $subCategory = Sub_Category::find($id);
            $subCategory->name = $request->name;
            $subCategory->category_id = $request->category_id;
            $subCategory->status = $request->status ? '1' : '0';
            $subCategory->save();

            return redirect()->route('all.sub.category')->with('success', 'sub category update successfully!');
        } catch (\Exception  $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function DestroyeSubCategory($id) {
        $deleteSubCategories = Sub_Category::find($id);
        $deleteSubCategories->delete();
        return redirect()->route('all.sub.category')->with('info','SubCategory are deleted Successfully');
    }
}
