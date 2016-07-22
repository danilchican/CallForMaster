<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests;
use App\Http\Requests\Account\UpdateSocialsRequest;
use App\Http\Requests\Account\UpdateMainSettingsRequest;
use App\Http\Requests\Account\UpdateContactsRequest;
use App\Http\Requests\Account\UpdatePhoneRequest;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

    /**
     * @return $this
     */

    public function index()
    {
        $user = Auth::user();

        return view('account.settings.index')->with(compact(['user']));
    }

    /**
     * @param UpdateSocialsRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function postUpdateSocials(UpdateSocialsRequest $request) {
        $groups = Auth::user()->company->contacts->groups;
        $attributes = ['vk_url', 'ok_url', 'fb_url'];

        if($request->ajax()) {
            $groups->limit(1)->update($request->only($attributes)); // one row

            return response()->json(['msg' => 'Настройки социальных сетей успешно обновлены']);
        }

        return redirect()->back()-with('msg', 'У вас браузере не включен javascript. Включите и обновите страницу.');
    }

    /**
     * @param UpdateMainSettingsRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

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

    /**
     * @param UpdateContactsRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */

    public function postUpdateContacts(UpdateContactsRequest $request) {
        $contacts = Auth::user()->company->contacts;

        if($request->ajax()) {
            $contacts->update($request->all())  ;

            return response()->json(['msg' => 'Настройки контактных данных успешно обновлены']);
        }

        return redirect()->back()-with('msg', 'У вас браузере не включен javascript. Включите и обновите страницу.');
    }

    public function phoneDelete(Request $request) {

        if($request->ajax()) {
            $phone = Phone::find($request->input('id'));
            $phone->delete();

            return response()->json(['msg' => 'Телефон удален']);
        }

        return redirect()->back()-with('msg', 'У вас браузере не включен javascript. Включите и обновите страницу.');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */

    public function phoneCreate() {
        $contacts = Auth::user()->company->contacts;

        if($contacts->phones()->count() + 1 > 3) {
            return response()->json(['msg' => 'Вы можете иметь не более 3-х номеров.'], 419);
        }

        $phone = $contacts->phones()->create([
            'number' => '',
        ]);

        return response()->json(view('account.settings.phones.item')->with(compact(['phone']))->render());
    }

    public function phoneUpdate(UpdatePhoneRequest $request) {

        if($request->ajax()) {
            $phone = Phone::find($request->input('id'));
            $phone->update($request->only(['number']));

            return response()->json(['msg' => 'Номер телефона обновлен.']);
        }

        return redirect()->back()-with('msg', 'У вас браузере не включен javascript. Включите и обновите страницу.');
    }
}
