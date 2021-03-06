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

    /**
     * Index companies page an admin-panel.
     *
     * @return $this
     */

    public function index()
    {
        return view('adminpanel.companies.index')->with([
            'companies' => Company::paginate(4),
            'title' => 'All Companies',
        ]);
    }

    /**
     * @return $this
     */

    public function newCompanies()
    {
    // to complete
        return view('adminpanel.companies.index')->with([
            'companies' => Company::paginate(4),
            'title' => 'New Companies (not completed)',
            'about' => 'This page display new companies for this week.'
        ]);
    }
}
