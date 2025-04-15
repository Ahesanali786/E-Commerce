<?php

namespace App\Http\Controllers;

use App\Models\Atribute;
use App\Models\AtributeValue;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AtributeValueController extends Controller
{
    public function showallvalue()
    {
        $veriantsvalues = AtributeValue::with('product', 'attribute')->get();
        // dd($veriantsvalues);
        return view('veriants.veriantsvalue', compact('veriantsvalues'));
    }
    public function createveriantsvalue(Request $request)
    {
        $products = Products::all();
        return view('veriants.addveriantsvelue', compact('products'));
    }

    public function getvariants(Request $request)
    {
        $getvarinats = Atribute::where('product_id', $request->Product_id)->get();
        return response()->json($getvarinats);
    }
    public function storeveriantsvalue(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name.*' => 'required|string|max:255',
            'veriants_id' => 'required',
            'Product_id' => 'required',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $veriantsvalues = [];

            foreach ($request->name as $key => $veriants) {
                $veriantsvalues[] = [
                    "variant_value" => $veriants,
                    "attributes_id" => $request->veriants_id[$key],
                    "product_id" => $request->Product_id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
            }

            if (!empty($veriantsvalues)) {
                AtributeValue::insert($veriantsvalues);
                return redirect()->route('create.veriants.velua')->with('success', 'Variants Value Added Successfully!');
            } else {
                return redirect()->back()->with('error', 'No Data Inserted!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function editveriantsvalue($id)
    {
        $editveriantsvalues = AtributeValue::with('product', 'attribute')->find($id);
        $products = Products::all();
        $veriants = Atribute::where('product_id',$editveriantsvalues->product->id)->get();

        // dd($editveriantsvalues);
        return view('veriants.updatevariantsvalue', compact('editveriantsvalues', 'products', 'veriants'));
    }
    public function updatevariants(Request $request)
    {
        $getvarinats = Atribute::where('product_id', $request->Product_id)->get();
        return response()->json($getvarinats);
    }
    public function updateveriantsvalue(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'veriants_id' => 'required|array',
            'Product_id' => 'required',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            foreach ($request->name as $key => $veriant) {
                $veriantValue = AtributeValue::find($id[$key]);

                // dd($veriantValue);
                if ($veriantValue) {
                    $veriantValue->variant_value = $veriant;
                    $veriantValue->attributes_id = $request->veriants_id[$key];
                    $veriantValue->product_id = $request->Product_id;
                    $veriantValue->updated_at = now();
                    // dd($veriantValue);
                    $veriantValue->save();
                }
            }

            return redirect()->route('veriants.value.list')->with('success', 'Variants Value updated successfully!');
        } catch (\Exception $e) {
            dump($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function deleteveriantsvalue($id)
    {
        $veriantsvalues = AtributeValue::find($id);
        $veriantsvalues->delete();

        return redirect()->back()->with('success', 'veriants value are deleted successfully!');
    }

    public function showproductsveriants() {}
}
