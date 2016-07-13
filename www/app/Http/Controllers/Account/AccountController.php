<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\File;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = $user->company;
        $countPhotos = $company->photos->count();

        $logo_url = (empty($company->logo_url) && File::exists("uploads/images/".$company->logo_url))
            ? "backend/themes/default/images/no_logo.svg"
            : "uploads/images/".$company->logo_url;

        return view('account.index', compact(['user', 'company', 'logo_url', 'countPhotos']));
    }
}
