<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tariff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

class TariffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminpanel.tariffs.index')->with([
            'tariffs' => Tariff::paginate(4),
            'title' => 'All Tariffs',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminpanel.tariffs.create')->with([
            'title' => 'Create New Tariff',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = ['title', 'whom', 'additional_service', 'top', 'published'];

        $tariff = new Tariff($request->only($attributes));
        $tariff->save();

        return redirect()->back()
            ->with(['message' => 'Tariff successfully added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tariff = Tariff::find($id);

        if(is_null($tariff))
            return redirect()->back()
                ->with(['message' => 'Tariff has not been found.']);

        $tariff->delete();

        return redirect()->back()
            ->with(['message' => 'Tariff successfully deleted.']);
    }
}
