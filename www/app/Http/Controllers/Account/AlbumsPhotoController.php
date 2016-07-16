<?php

namespace App\Http\Controllers\Account;

use App\Models\Album;
use App\Models\Photo;

use File;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AlbumsPhotoController extends Controller
{

    /**
     * Create new photo and add it to the album.
     *
     * @param Request $request
     * @return mixed
     */

    public function create(Request $request)
    {
        //get the file from the post request

        $file = $request->file('file');

        //set file name

        $filename = uniqid().$file->getClientOriginalName();

        //move the file to correct location

        $file->move('uploads/albums', $filename);

        //save the image details to the database

        $album = Album::find($request->input('album_id'));

        $photo = $album->photos()->create([
            'title' => $filename,
            'image_url' => 'uploads/albums/'.$filename
        ]);

        return $photo;
    }

    public function delete(Request $request)
    {
        $photo = Photo::find($request->input('id'));

        if(File::exists($photo->image_url)) {
            File::delete($photo->image_url);
        }

        $photo->delete();

        return response()->json([
            'success' => true,
            'message' => "Изображение успешно удалено."
        ]);
    }
}
