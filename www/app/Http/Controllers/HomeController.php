<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\PrsoCategory;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PrsoCategory::withDepth()->having('depth', '=', 0)->get()->toTree();
        $subHeadsCategories = PrsoCategory::get()->toTree();

        return view('welcome')->with(compact(['categories', 'subHeadsCategories']));
    }
}
