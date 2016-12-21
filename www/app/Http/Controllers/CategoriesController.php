<?php

namespace App\Http\Controllers;

use App\Models\PrsoCategory;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{

    /**
     * @param $category
     * @return $this|\Illuminate\Http\Response
     */
    public function show($category)
    {
            try {
                $cat = PrsoCategory::withDepth()->where('slug', '=', $category)->first();

                if(!$cat) {
                    throw new \Exception();
                }

                $categories = $cat->children;

                if($categories->isEmpty()) {
                    $depth = $cat->depth - 1;

                    $category = $cat->ancestors()->withDepth()->having('depth', '=', $depth)->first();

                    $categories = PrsoCategory::descendantsOf($category->id);
                }

                return view('categories.category')->with([
                    'categories' => $categories,
                    'companies' => $cat->companies()->published()->paginate(5),
                ]);

            } catch (\Exception $e) {
                return response()->view('errors.'.'503');
            }
    }
}
