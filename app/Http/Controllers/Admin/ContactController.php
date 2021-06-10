<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contacts;

class ContactController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "contact") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $contacts = contacts::with('user')->paginate(self::$itemPerPage);
        return view('admin.contacts.index',compact('contacts'));
    }

    public function updateStatus( Request $request, $id)
    {
        if (str_contains(auth('admin')->user()->permissions, "contact") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $country = contacts::where('id', '=', $id)->first();
        if($country->is_open ==  1)
        {
            $country->is_open   = 0;
            $country->update();
            toastr()->success('تم تحديث حالة الرسالة بنجاح');
            return redirect()->route('contacts.index');
        } elseif($country->is_open == 0) {
            $country->is_open = 1;
            $country->update();
            toastr()->success('تم تحديث حالة الرسالة بنجاح');
            return redirect()->route('contacts.index');
        }
    }
}
