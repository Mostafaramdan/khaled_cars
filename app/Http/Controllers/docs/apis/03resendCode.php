<?php
return [
    'name'=>'resendCode',
    'description'=>'this api used to resend code to phone \'users which it required to confirm phone,this code ',
    'notes'=>' this api used in three cases , first after register ,second after forget password , third after update phone. '."<br>".
     'you can use this code only every 2 minutes .',
    'params'=>
        [
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'required min:9 max:15 between:10000000,999999999999999 unique',
            ],

        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'message'=>'code has been sent'
            ],
        ],
        [
            'status'=>416,
            'params'=>[
                'message'=>'failed ,wait 2 minutes and try again'
            ],
        ],
    ]
];
