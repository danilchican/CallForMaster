<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PrsoCategory as Category;

class PrsoCategoryController extends Controller
{

    public function index()
    {
        $parents = Category::get();
        $categories = $parents->toTree();
        return view('adminpanel.categories.index')->with(compact('categories', 'parents'));
    }

    public function postCreateCategory(CreateCategoryRequest $request)
    {
        if($request->ajax()) {
            $parent_id = $request->input('parent_id');
            $node = new Category($request->except(['parent_id']));
            if($parent_id > 0) {
                $parent = Category::find($parent_id);
                $node->appendToNode($parent)->save();
            } else {
                $node->save(); // Saved as root
            }

            return response()->json(['msg' => 'Категория добавлена']);
        }

        return redirect()->back()-with('msg', 'У вас браузере не включен javascript. Включите и обновите страницу.');
    }
}
