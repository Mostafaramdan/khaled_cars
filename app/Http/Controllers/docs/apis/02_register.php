<?php
return
[
    'name'=>'register',
    'description'=>'this api used to register new user in the application',
    'params'=>
        [
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required min:3 max:30',
            ],
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'required min:9 max:15 between:10000000,999999999999999 unique',
            ],
            [
                'name'=>'password',
                'dataType'=>'string',
                'validation'=>'required min:6 max:20',
            ],
            [
                'name'=>'email',
                'dataType'=>'string',
                'validation'=>'optional',
            ],
            [
                'name'=>'image',
                'dataType'=>'string',
                'validation'=>'optional',
            ],
            [
                'name'=>'fireBaseToken',
                'dataType'=>'string',
                'validation'=>'optional',
                'description'=>'using it in push notifications'
            ]

        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'account'=>'<a href="#account">account</a>'
            ],
        ],
        [
            'status'=>408,
            'params'=>[
                'message'=>'phone is unique '
            ],
        ],
        [
            'status'=>409,
            'params'=>[
                'message'=>'email is unique '
            ],
        ],
    ]
];
