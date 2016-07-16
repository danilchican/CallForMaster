<?php

namespace App\Http\Controllers\Account;

use App\Models\Album;
use File;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as Controller;

class AlbumsController extends Controller
{

    private $no_js = "У вас браузере не включен javascript. Включите и обновите страницу.";

    /**
     * Index page of company albums.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $company = Auth::user()->company;
        $albums = $company->albums;

        return view('account.albums.index', compact(['albums', 'company']));
    }

    /**
     * Create new album owned by company.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function create(Request $request)
    {
        if($request->ajax()) {

            $album = new Album($request->all());

            Auth::user()->company->albums()->save($album);

            return response()->json(['msg' => 'Альбом добавлен. Обновите страницу.']);
        }

        return redirect()->back()-with('msg', $this->no_js);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function view(Request $request, $id)
    {
        $album = Album::find($id);
        $company = Auth::user()->company;

        return view('account.albums.view', compact(['album', 'company']));
    }

    public function delete(Request $request)
    {
        $album = Album::find($request->input('id'));

        foreach($album->photos as $photo)
        {
            if(File::exists($photo->image_url)) {
                File::delete($photo->image_url);
            }
        }

        $album->delete();

        return response()->json(['message' => 'Альбом удален.']);
    }
}
