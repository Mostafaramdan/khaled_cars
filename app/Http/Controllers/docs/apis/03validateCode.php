<?php
return
[
    'name'=>'validateCode',
    'description'=>'this api used to validate code which sent to user\'s phone',
    'notes'=>'this api used in three cases <br>
        <b> case 1 : </b> after register , <br>
        <b> case 2 : </b> after forget password <br>
        <b> case 3 : </b> after update profile, just when send phone
    ',
    'params'=>
        [
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'optional between:10000000,99999999999999999999',
                'description'=>'should sent after register'
            ],
            [
                'name'=>'tmpToken',
                'dataType'=>'string',
                'validation'=>'optional ',
                'description'=>'should sent after forgetPassword'
            ],
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'optional ',
                'description'=>'should sent after updateProfile'
            ],
            [
                'name'=>'code',
                'dataType'=>'int',
                'validation'=>'required length=5',
            ],
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'account'=>'<a href="#account">account</a>',
                'apiToken'=>'string sent when send phone',
                'tmpToken'=>'string sent when send tmpToken',
                'phone'=>'string sent when send apiToken',
            ],
        ],
        [
            'status'=>410,
            'params'=>[
                'message'=>'wrong code or expired'
            ],
        ],
    ]
];
