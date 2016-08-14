<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Company;
use App\Models\Review;

class ReviewsController extends Controller
{

    /**
     * Create new review for a company.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */

    public function create(Requests\CreateReviewRequest $request)
    {
        try {
            $company = Company::findOrFail($request->input('company-id'));
            $review = new Review($request->except('company-id'));

            $company->reviews()->save($review);

            return redirect()->back()->with([
                'message' => 'Отзыв будет опубликован после модерации.'
            ]);

        } catch (\Exception $e) {
            return response()->view('errors.'.'503');
        }

    }

    public function delete(Request $request)
    {

    }
}
