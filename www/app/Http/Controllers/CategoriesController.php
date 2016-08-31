<?php

namespace App\Http\Controllers;

use App\Models\PrsoCategory;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    public function show($category, $subcategory = null)
    {
        if($subcategory != null) {
            try {
                $cat = PrsoCategory::withDepth()->where('slug', '=', $subcategory)->having('depth', '=', 1)->first();

                if(!$cat) {
                    throw new \Exception();
                }

                return view('categories.category')->with([
                    'companies' => $cat->companies()->published()->paginate(5)
                ]);
            } catch (\Exception $e) {
                return response()->view('errors.'.'503');
            }
        } else {
            try {
                $cat = PrsoCategory::withDepth()->having('depth', '=', 0)->where('slug', '=', $category)->first();

                if(!$cat) {
                    throw new \Exception();
                }



                return view('categories.index')->with([
                    'categories' => $cat->children,
                    'parent' => $cat->slug
                ]);
            } catch (\Exception $e) {
                return response()->view('errors.'.'503');
            }
        }
    }
}
