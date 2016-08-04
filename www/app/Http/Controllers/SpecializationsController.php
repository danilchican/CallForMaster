<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Specializations\CreateSpecializationRequest;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class SpecializationsController extends Controller
{

    private $no_js = "У вас браузере не включен javascript. Включите и обновите страницу.";

    /**
     * Index specializations page an admin-panel
     *
     * @return $this
     */

    public function index()
    {
        return view('adminpanel.specializations.index')->with([
            'specializations' => Specialization::all(),
            'title' => 'All Specializations',
        ]);
    }

    /**
     * Index specializations page an account
     *
     * @return $this
     */

    public function indexAccount()
    {
        return view('account.specializations.index')->with([
            'company' => Auth::user()->company,
            'specializations' => Specialization::all(),
            'title' => 'All Specializations',
        ]);
    }

    /**
     * @param CreateSpecializationRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function create(CreateSpecializationRequest $request)
    {
        if($request->ajax()) {
            $specialization = Specialization::create($request->all());

            $viewSpecialization = view('adminpanel.specializations.view')->with('specialization', $specialization)->render();

            return response()->json(['msg' => 'Специальность добавлена', 'view' => $viewSpecialization]);
        }

        return redirect()->back()->with('msg', $this->no_js);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $specialization = Specialization::find($request->input('id'));

            if(is_null($specialization))
                return response()->json(['msg' => 'Такой специальности не существует']);

            $specialization->delete();

            return response()->json(['msg' => 'Специальность удалена']);
        }

        return redirect()->back()->with('msg', $this->no_js);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function edit(Request $request) {

        if($request->ajax()) {
            $specialization = Specialization::find($request->input('id'));

            if(is_null($specialization))
                return response()->json(['msg' => 'Такой специальности не существует']);

            return response()->json($specialization);
        }

        return redirect()->back()->with('msg', $this->no_js);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        if($request->ajax()) {
           $specialization = Specialization::find($request->input('id'));

            if(is_null($specialization))
                return response()->json(['success' => false, 'msg' => 'Такой специальности не существует'], 422);

            $specialization->update($request->all());

            return response()->json(['msg' => 'Специальность обновлена. Обновите страницу.']);
        }

        return redirect()->back()->with('msg', $this->no_js);
    }

    public function updateSpecialsRelations(Request $request)
    {
        if($request->ajax()) {
            $company = Auth::user()->company;
            $ids = (empty($request->input('specials'))) ? [] : $request->input('specials');

            $company->specializations()->sync($ids);

            return response()->json(['msg' => 'Изменения сохранены. Обновите страницу.']);
        }

        return redirect()->back()->with('msg', $this->no_js);
    }
}
