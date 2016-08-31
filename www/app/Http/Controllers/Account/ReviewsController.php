<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reviews = $user->company->reviews()->get();

        return view('account.reviews.index')->with(compact(['user', 'reviews']));
    }
}
