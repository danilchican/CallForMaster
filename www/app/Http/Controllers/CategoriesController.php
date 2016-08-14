<?php

namespace App\Http\Controllers;

use App\Models\PrsoCategory;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    public function index($slug)
    {
        try {
            $category = PrsoCategory::where('slug', '=', $slug)->first();

            if(!$category) {
                throw new \Exception();
            }

            return view('categories.index')->with([
                'companies' => $category->companies()->published()->paginate(5)
            ]);
        } catch (\Exception $e) {
            return response()->view('errors.'.'503');
        }
    }
}
