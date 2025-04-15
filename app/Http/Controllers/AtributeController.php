<?php

namespace App\Http\Controllers;

use App\Models\Atribute;
use App\Models\Products;
use Illuminate\Http\Request;

class AtributeController extends Controller
{
    public function showallveriants()
    {
        $allveriants = Atribute::all();
        return view('veriants.veriantslist', compact('allveriants'));
    }
    public function createvariants(Request $request, $id = null)
    {
        if ($id) {
            $editveriant = Atribute::with('Product')->find($id);
            $products = Products::get();
            return view('veriants.addveriants', compact('editveriant', 'products'));
        }
        $products = Products::get();
        return view('veriants.addveriants', compact('products'));
    }
    public function storeveriants(Request $request)
    {
        $request->validate([
            'name' => 'required|max:10'
        ], [
            'name.required' => 'please enter veriant name!',
            'name.max' => 'The veriant name field must not be greater than 10 characters.'
        ]);

        try {
            $varinats = [];
            foreach ($request->name as $veriants) {
                $varinats[] = [
                    "variant_name" => $veriants,
                    "product_id" => $request->Product_id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
            }
            if (!empty($varinats)) {
                Atribute::insert($varinats);
                return redirect()->route('veriants.list')->with('success', 'Variants Add SuccessFylly');
            } else {
                return redirect()->back()->with('error', 'No Data Inserted!');
            }
        } catch (\Exception $e) {
            dd($e)->getMessage();
        }
    }
    public function updateveriants(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:10',
            'Product_id' => 'required'
        ], [
            'name.required' => 'please enter veriant name!',
            'name.max' => 'The veriant name field must not be greater than 10 characters.',
            'Product_id.required' => 'Please Seledct Products'
        ]);

        try {

            $veriants = Atribute::find($id);
            $veriants->variant_name = $request->name;
            $veriants->save();

            return redirect()->route('veriants.list')->with('success', 'Variants update SuccessFylly');
        } catch (\Exception $e) {
            dd($e)->getMessage();
        }
    }
    public function deleteveriants($id)
    {
        $veriants = Atribute::find($id);
        $veriants->delete();

        return redirect()->back()->with('success', 'veriant are deleted successfully!');
    }
}
