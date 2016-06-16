<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Categories\CreateCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrsoCategory as Category;

class PrsoCategoryController extends Controller
{

    private $no_js = "У вас браузере не включен javascript. Включите и обновите страницу.";

    /**
     *
     * Displaying index category page
     *
     * @return $this
     */
    public function index()
    {
        $parents = Category::get();
        $categories = $parents->toTree();

        return view('adminpanel.categories.index')->with(compact('categories', 'parents'));
    }

    /**
     *
     * Create a new category
     *
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function create(CreateCategoryRequest $request)
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

            return response()->json(['msg' => 'Категория добавлена', 'id' => $node->id]);
        }

        return redirect()->back()-with('msg', $this->no_js);
    }

    /**
     *
     * Update exists category
     *
     * @param UpdateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request)
    {
        if($request->ajax()) {
            $parent_id = $request->input('parent_id');
            $node = Category::find($request->input('id'));

            if(is_null($node))
                return response()->json(['success' => false, 'msg' => 'Такой категории не существует'], 422);

            $node->fill($request->except('parent_id'));

            if($parent_id > 0) {
                $parent = Category::find($parent_id);
                $node->appendToNode($parent)->save();
            } else {
                $node->update(); // Saved as root
            }

            return response()->json(['msg' => 'Категория обновлена. Обновите страницу.']);
        }

        return redirect()->back()-with('msg', $this->no_js);
    }

    /**
     *
     * Delete category from database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        if($request->ajax()) {
            $category = Category::find($request->input('id'));

            if(is_null($category))
                return response()->json(['msg' => 'Такой категории не существует']);

            $category->delete();

            return response()->json(['msg' => 'Категория удалена']);
        }

        return redirect()->back()-with('msg', $this->no_js);
    }

    /**
     *
     * Edit existing category
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request) {

        if($request->ajax()) {
            $category = Category::find($request->input('id'));

            if(is_null($category))
                return response()->json(['msg' => 'Такой категории не существует']);

            return response()->json($category);
        }

        return redirect()->back()-with('msg', $this->no_js);
    }

    /**
     * @param Request $request
     * @param $keyword
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request, $keyword) {
        $categories = Category::SearchByKeyword($keyword)->get()->toTree();

        return response()->json($categories);
    }

}