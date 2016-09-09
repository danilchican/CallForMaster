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
            $reviews = $company->reviews()->get();

            $phones = $company->contacts->phones()->filled()->get();
            $groups = $company->contacts->groups;

            $logo_url = (empty($company->logo_url) && File::exists("uploads/images/".$company->logo_url))
                ? "backend/themes/default/images/no_logo.svg"
                : "uploads/images/".$company->logo_url;

            return view('companies.cart')->with(compact(['company', 'reviews', 'phones', 'groups', 'logo_url']));
        } catch (\Exception $e) {
            return response()->view('errors.'.'503');
        }
    }

}
