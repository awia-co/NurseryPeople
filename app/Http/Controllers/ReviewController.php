<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Plant;
use App\Models\Review;
use Illuminate\Support\Facades\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['plantReviews', 'companyReviews']]);
    }

    //View Plant Reviews
    public function plantReviews(Plant $plant)
    {
        return $plant->reviews()->latest()->paginate(20);
    }

    //View nursery Reviews
    public function companyReviews(Company $company)
    {
        return $company->reviews()->latest()->paginate(20);
    }

    //Review Plants
    public function storePlantReview(Plant $plant)
    {
        return $plant->addReview([
            'body' => request('body'),
            'rating' => request('rating'),
            'user_id' => auth()->id(),
        ]);
    }

    //Review Companies
    public function storeCompanyReview(Company $company)
    {
        return $company->addReview([
            'body' => request('body'),
            'rating' => request('rating'),
            'user_id' => auth()->id(),
        ]);
    }

    public function update(Review $review)
    {
        $this->authorize('update', $review);

        $data = request()->validate(['body' => 'spamfree', 'rating' => 'required|max:5']);

        $review->update($data);
    }

    public function destroy(Review $review)
    {
        $this->authorize('update', $review);

        $review->delete();

        //for ajax requests:
        if (request()->expectsJson()) {
            return response(['flash' => 'Reply Deleted']);
        }
    }

    public function addReview($review)
    {
        if (!$this->isReviewed()) {
            $review = $this->reviews()->create($review);

            return $review;
        } else {
            abort('403', "Sorry, you've already left a review on this item.");
        }
    }
}
