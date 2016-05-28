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
        return view('adminpanel.companies.index')->with([
            'companies' => Company::paginate(2),
            'title' => 'All Companies',
        ]);
    }

    public function newCompanies()
    {
    // to complete
        return view('adminpanel.companies.index')->with([
            'companies' => Company::paginate(2),
            'title' => 'New Companies (not completed)',
            'about' => 'This page display new companies for this week.'
        ]);
    }
}
