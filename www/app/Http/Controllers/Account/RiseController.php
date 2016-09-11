<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Tariff;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiseController extends Controller
{
    public function index() {
        $user = Auth::user();
        $company = $user->company;
        $tariffs = Tariff::published()->get();

        return view('account.rise.index')->with(compact(['user', 'company', 'tariffs']));
    }
}
