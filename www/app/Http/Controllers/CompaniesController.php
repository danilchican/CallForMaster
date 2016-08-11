<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Company;

class CompaniesController extends Controller
{
    public function index()
    {
        return view('companies.index')->with([
            'companies' => Company::published()->paginate(4),
            'title' => 'All Companies',
        ]);
    }

    public function cart($id)
    {
        try {
            $company = Company::findOrFail($id);

            return view('companies.cart')->with(compact(['company']));
        } catch (\Exception $e) {
            return response()->view('errors.'.'503');
        }
    }

}
