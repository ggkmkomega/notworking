<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function Add(Request $request, $prod_category, $prod_id) {

        $valid = $request->validate([
            'stars' => 'required',
            'review' => 'required',
        ]);

        $newReview = new Review;
        $newReview->client_id = Auth::user()->id;
        $newReview->prod_id = $prod_id;
        $newReview->prod_category = $prod_category;
        $newReview->stars = $valid['stars'];
        $newReview->review = $valid['review'];
        $newReview->is_approved = true;
        $newReview->save();

        return redirect()->back();
    }
    
    public function IndexForUser() {
        $reviews = Review::where('client_id', '=', Auth::user()->id)->get();
        return view('user.dashboard.review.index', compact('reviews'));
    }

    public function Remove(Review $review) {
        $review->delete();
        return redirect(route('indexForUser'));
    }

    public function Edit(Request $request, Review $review) {
        $valid = $request->validate([
            'stars' => 'required',
            'review' => 'required',
        ]);

        $review->stars = $valid['stars'];
        $review->review = $valid['review'];
        $review->save();

        return redirect(route('indexForUser'));
    }
}
