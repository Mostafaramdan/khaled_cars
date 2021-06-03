<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper ;
use App\Models\admins;

class login extends Controller
{
    public function login(Request $request)
    {
        $admin = admins::where('email',$request->username)
                       ->orWhere('phone',$request->username)
                       ->first();
        if(!$admin){
            return [
                'status'=> 232,
                'message' => 'هذا الايميل غير مسجل'
            ];
        }else{
            if(helper::login($admin, $request->password)){
                if($request->type == 'dashboard'){
                    return [
                        'status'=> 200,
                        'account'=>$admin,
                    ];
                }
                return [
                    'status'=> 200,
                    'account'=>users::resource($admin),
                ];
            }else{
                return [
                    'status'=> 233,
                    'message' => 'الرقم السري غير صحيح'
                ];

            }
        }
    }
}
