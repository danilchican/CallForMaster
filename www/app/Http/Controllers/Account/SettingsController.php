<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests;
use App\Http\Requests\Account\UpdateSocialsRequest;
use App\Http\Requests\Account\UpdateMainSettingsRequest;
use App\Http\Requests\Account\UpdateContactsRequest;
use Illuminate\Support\Facades\Auth;

use Debugbar;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        return view('account.settings.index')->with(['user' => Auth::user()]);
    }

    public function postUpdateSocials(UpdateSocialsRequest $request) {
        $groups = Auth::user()->company->contacts->groups;
        $attributes = ['vk_url', 'ok_url', 'fb_url'];

        if($request->ajax()) {
            $groups->limit(1)->update($request->only($attributes)); // one row

            return response()->json(['msg' => 'Настройки социальных сетей успешно обновлены']);
        }

        return redirect()->back()-with('msg', 'У вас браузере не включен javascript. Включите и обновите страницу.');
    }

    public function postUpdateMainSettings(UpdateMainSettingsRequest $request) {
        $user = Auth::user();

        if($request->ajax()) {
            $req_company = $request->get('company'); // company data
            $req_company['unp_number'] = (empty($req_company['unp_number'])) ? null : $req_company['unp_number'];

            $user->company->update($req_company);
            $user->update($request->get('user'));

            return response()->json(['msg' => 'Настройки успешно обновлены']);
        }

        return redirect()->back()-with('msg', 'У вас браузере не включен javascript. Включите и обновите страницу.');
    }

    public function postUpdateContacts(UpdateContactsRequest $request) {
        $contacts = Auth::user()->company->contacts;
        $attributes = ['address', 'website_url', 'email', 'skype', 'viber', 'icq'];

        if($request->ajax()) {
            $contacts->update($request->only($attributes));

            return response()->json(['msg' => 'Настройки контактных данных успешно обновлены']);
        }

        return redirect()->back()-with('msg', 'У вас браузере не включен javascript. Включите и обновите страницу.');
    }

}
