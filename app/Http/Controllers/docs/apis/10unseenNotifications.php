<?php
return [
    'name'=>'unseenNotifications',
    'description'=>'this api used to get count of unseen notifications of user.',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'password',
                'dataType'=>'string',
                'validation'=>'required min:6 max:20',
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'count'=>'int'
            ],
        ],

    ]
];
