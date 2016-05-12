<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as Request;

class ImageController extends Controller
{
    public function postUploadLogo(Request $request) {
        if($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'logo' => 'required|image|mimes:jpeg,jpg,gif,png|max:1000'
            ]);

            if($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ]);
            }

            if(Input::hasFile('logo')) {

                $logo = $request->file('logo');
                $path = 'uploads/images';
                $logo_name = Auth::user()->id."_".time()."_".$logo->getClientOriginalName();
                $moved = $logo->move($path, $logo_name);

                if($moved) {
                    $user = Auth::user();
                    $user->company->logo_url = $logo_name;
                    $user->company->save();

                    return response()->json([
                        'success' => true,
                        'logo_url' =>  $path."/".$logo_name,
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'message' => "Не удалось загрузить изображение"
                ]);

            }

            return response()->json([
                'success' => false,
                'message' => "Файл не выбран"
            ]);
        }
    }

    public function postUploadPhotos(Request $request) {

    }
}
