<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as Controller;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index')->with(['user' => Auth::user()]);
    }
}
