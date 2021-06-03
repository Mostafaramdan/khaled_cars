<?php
return
[
    'name'=>'changePassword',
    'description'=>'this api used to change password of user\'account .',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'oldPassword',
                'dataType'=>'string',
                'validation'=>'required min:6 max:20',
            ],
            [
                'name'=>'newPassword',
                'dataType'=>'string',
                'validation'=>'required min:6 max:20',
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
            ],
        ],
    ]
];
