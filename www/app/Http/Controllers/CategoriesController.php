<?php

namespace App\Http\Controllers;

use App\Models\PrsoCategory;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{


    /**
     * @param $category
     * @param null $subcategory
     * @return $this|\Illuminate\Http\Response
     */
    public function show($category)
    {
            try {
                $cat = PrsoCategory::withDepth()->where('slug', '=', $category)->first();

                if(!$cat) {
                    throw new \Exception();
                }

                return view('categories.category')->with([
                    'categories' => $cat->children,
                    'companies' => $cat->companies()->published()->paginate(5),
                ]);
            } catch (\Exception $e) {
                return response()->view('errors.'.'503');
            }
    }
}
