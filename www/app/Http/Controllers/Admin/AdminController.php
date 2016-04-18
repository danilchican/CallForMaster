<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\Company;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_group');
    }

    public function index()
    {
        return view('adminpanel.index')->with(['countCompanies' => Company::count()]);
    }
}
