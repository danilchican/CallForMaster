<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller as Controller;
use App\Models\PrsoCategory as Category;

class WorkController extends Controller
{
    public function indexTypes() {

        $parents = Category::get();
        $categories = $parents->toTree();
        $dep = '-';

        return view('account.settings.work.types')->with(compact('categories', 'parents', 'dep'));
    }
}
