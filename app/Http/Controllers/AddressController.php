<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * get loggedin user addess
     */
    public function showAddress()
    {
        $userId = Auth::id();
        //get loggedin user address
        $addresses = Address::where('user_id', $userId)->get();

        return view('website.user-accounts.user-address', compact('addresses'));
    }
    public function addNewAddress()
    {
        return view('website.user-accounts.add-address');
    }

    /**
     * store user address
     */
    public function storeAddress(Request $request)
    {
        //validate user address
        $request->validate([
            'name' => 'required|string|max:25',
            'phone' => 'required|digits:10',
            'zip' => 'required|digits:6',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'required|max:255',
            'locality' => 'required|max:255',
            'landmark' => 'required|string|max:255',
        ], [
            'name.required' => 'Please enter your full name.',
            'name.max' => 'Please enter name must be 25 character.',
            'phone.required' => 'Please enter your phone number.',
            'phone.digits' => 'Phone number must be 10 digits.',
            'zip.required' => 'Please enter your pincode.',
            'zip.digits' => 'Pincode must be 6 digits.',
            'state.required' => 'Please enter your state.',
            'state.string' => 'Please enter must be a character.',
            'city.string' => 'Please enter must be a character.',
            'city.required' => 'Please enter your city.',
            'address.required' => 'Please enter your house or building name.',
            'locality.required' => 'Please enter your area or colony.',
            'landmark.required' => 'Please enter a landmark near your location.',
        ]);

        try {
            $userDetails = new Address();
            $userDetails->user_id = Auth::id();
            $userDetails->name = $request->name;
            $userDetails->phone_no = $request->phone;
            $userDetails->pincode = $request->zip;
            $userDetails->state = $request->state;
            $userDetails->city = $request->city;
            $userDetails->house_no = $request->address;
            $userDetails->area = $request->locality;
            $userDetails->landmark = $request->landmark;
            // dd($userDetails);
            $userDetails->save();
            return redirect()->route('user.accounts.address')->with('success', 'Address Added Successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function editAddress($id)
    {
        // find address with id
        $editAddress = Address::find($id);
        return view('website.user-accounts.update-address', compact('editAddress'));
    }

    /**
     * user inserted address update
     */
    public function updateAddress(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'phone' => 'required|digits:10',
            'zip' => 'required|digits:6',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'required|max:255',
            'locality' => 'required|max:255',
            'landmark' => 'required|string|max:255',
        ], [
            'name.required' => 'Please enter your full name.',
            'name.max' => 'Please enter name must be 25 character.',
            'phone.required' => 'Please enter your phone number.',
            'phone.digits' => 'Phone number must be 10 digits.',
            'zip.required' => 'Please enter your pincode.',
            'zip.digits' => 'Pincode must be 6 digits.',
            'state.required' => 'Please enter your state.',
            'state.string' => 'Please enter must be a character.',
            'city.string' => 'Please enter must be a character.',
            'city.required' => 'Please enter your city.',
            'address.required' => 'Please enter your house or building name.',
            'locality.required' => 'Please enter your area or colony.',
            'landmark.required' => 'Please enter a landmark near your location.',
        ]);

        try {
            $userDetails = Address::find($id);
            $userDetails->user_id = Auth::id();
            $userDetails->name = $request->name;
            $userDetails->phone_no = $request->phone;
            $userDetails->pincode = $request->zip;
            $userDetails->state = $request->state;
            $userDetails->city = $request->city;
            $userDetails->house_no = $request->address;
            $userDetails->area = $request->locality;
            $userDetails->landmark = $request->landmark;
            $userDetails->save();
            return redirect()->route('user.accounts.address')->with('success', 'Address Update Successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * find address id and delete address
     */
    public function deleteAddress($id) {
        $deleteAddress = Address::find($id);
        $deleteAddress->delete();

        return redirect()->back()->with('success','Address Deleted Successfully');
    }
}
