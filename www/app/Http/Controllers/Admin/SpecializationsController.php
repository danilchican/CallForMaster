<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Specializations\CreateSpecializationRequest;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Specialization;

use App\Http\Requests;

class SpecializationsController extends Controller
{

    private $no_js = "У вас браузере не включен javascript. Включите и обновите страницу.";

    public function __construct()
    {
        $this->middleware('admin_group');
    }

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
     * @param CreateSpecializationRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function create(CreateSpecializationRequest $request)
    {
        if($request->ajax()) {
            $specialization = Specialization::create($request->all());

            return response()->json(['msg' => 'Категория добавлена', 'special' => $specialization]);
        }

        return redirect()->back()-with('msg', $this->no_js);
    }
}
