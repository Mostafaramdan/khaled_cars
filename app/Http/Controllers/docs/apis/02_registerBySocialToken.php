<?php
return
[
    'name'=>'registerBySocialToken',
    'description'=>'this api used to register new user by socail token  in the application',
    'params'=>
        [
            [
                'name'=>'socialToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required min:3 max:30',
            ],
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'optional min:9 max:15 between:10000000,999999999999999 unique',
            ],
            [
                'name'=>'email',
                'dataType'=>'string',
                'validation'=>'optional unique',
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
