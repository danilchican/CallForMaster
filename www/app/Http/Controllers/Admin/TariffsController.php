<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tariff;
use App\Models\Service;
use App\Models\Price;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdditional()
    {
        return view('adminpanel.tariffs.additionals.index')->with([
            'services' => Service::paginate(4),
            'title_service' => 'All Services',
        ]);
    }

    /**
     * Create service.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createService(Request $request)
    {
        $service = new Service($request->all());
        $service->save();

        return redirect()->back()
            ->with(['message' => 'Service successfully created.']);
    }

    public function destroyService(Request $request)
    {
        $service = Service::find($request->input('service_id'));

        if(is_null($service))
            return redirect()->back()
                ->with(['message' => 'Service has not been found.']);

        $service->delete();

        return redirect()->back()
            ->with(['message' => 'Service successfully deleted.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminpanel.tariffs.create')->with([
            'title' => 'Create Tariff',
            'about' => '<p>At this page you can create new tariff.</p>',
            'services' => Service::all(),
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

        $prices = $request->input('prices');
        $ranges = $request->input('ranges');

        $services = $request->input('services');

        $services_objects = [];
        $prices_objects = [];

        if($services) {
            foreach($services as $service) {
                $service_obj = new Service();
                $service_obj->setTitle($service);
                $services_objects[] = $service_obj;
            }
        }

        if(count($prices) == count($ranges)) {
            for($i = 0; $i < count($prices); $i++) {
                $price = new Price();
                $price->setPrice($prices[$i]);
                $price->setRange($ranges[$i]);
                $prices_objects[] = $price;
            }
        }

        $tariff = new Tariff($request->only($attributes));
        $tariff->save();

        $tariff->services()->saveMany($services_objects);
        $tariff->prices()->saveMany($prices_objects);

        return redirect()->route('admin.tariffs.index')
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
