<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\PrsoCategory as Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    private $no_js = "У вас браузере не включен javascript. Включите и обновите страницу.";

    public function indexTypes() {
        $company = Auth::user()->company;
        $parents = Category::get();
        $categories = $parents->toTree();
        $dep = '-';

        return view('account.settings.work.types')->with(compact('categories', 'parents', 'dep', 'company'));
    }

    /**
     * Update selected categories for a company.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        if($request->ajax()) {
            $company = Auth::user()->company;
            $ids = (empty($request->input('works'))) ? [] : $request->input('works');

            $company->categories()->sync($ids);

            return response()->json(['msg' => 'Изменения сохранены. Обновите страницу.']);
        }

        return redirect()->back()->with('msg', $this->no_js);
    }
}
