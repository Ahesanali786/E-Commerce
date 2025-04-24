<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function storeProductReview(Request $request)
    {
        $request->validate([
            'name' => 'required|max:15|min:3',
            'email' => 'required|email',
            'review' => 'required',
            'product_rating' => 'required'
        ], [
            'name.required' => 'Please enter your name.',
            'name.max' => 'Your name must not be more than 15 characters.',
            'name.min' => 'Your name must be at least 3 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'review.required' => 'Please write your review.',
            'product_rating.required' => 'Please give a product rating.'
        ]);

        try {
            $productReview = new Review();
            $productReview->name = $request->name;
            $productReview->user_id = Auth::id();
            $productReview->product_id = $request->product_id;
            $productReview->orderDetails_id = $request->orderDetails_id;
            $productReview->email = $request->email;
            $productReview->product_review = $request->review;
            $productReview->rating = $request->product_rating;
            $productReview->save();

            return redirect()->route('my.orders')->with('success', 'Review Added Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Please Chack Your Review');
        }
    }
}
