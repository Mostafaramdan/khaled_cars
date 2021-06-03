<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contacts;

class ContactController extends Controller
{
    public function index(){
        $contacts = contacts::with('user')->get();
        return view('admin.contacts.index',compact('contacts'));
    }

    public function updateStatus( Request $request, $id)
    {
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
