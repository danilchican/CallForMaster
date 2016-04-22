<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as Controller;

class ReviewsController extends Controller
{
    public function index()
    {
        return view('account.reviews.index')->with(['user' => Auth::user()]);
    }
}
