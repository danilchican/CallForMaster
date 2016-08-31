<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\Company;
use App\Models\Review;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_group');
    }

    public function index()
    {
        $countCompanies = Company::count();
        $countReviews = Review::count();


        return view('adminpanel.index')->with(compact(['countCompanies', 'countReviews']));
    }
}
