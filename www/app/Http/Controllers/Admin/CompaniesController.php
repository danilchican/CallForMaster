<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\Company;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_group');
    }

    public function index()
    {

        $companies = Company::paginate(10);

        return view('adminpanel.companies.index')->with(['companies' => $companies]);
    }
}
