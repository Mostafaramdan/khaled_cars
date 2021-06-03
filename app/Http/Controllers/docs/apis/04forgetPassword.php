<?php
return
[
    'name'=>'forgetPassword',
    'description'=>'this api used when user forget his password .',
    'notes'=>'email and phone are optional, but you must at least send one of them',
    'params'=>
        [
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'optional between:10000000,999999999999999',
            ],
            [
                'name'=>'email',
                'dataType'=>'string',
                'validation'=>'optional',
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                '(tmpToken)'=>'string => you will used it then in validateCode',
            ],
        ]
    ]
];
