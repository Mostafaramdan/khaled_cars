<?php
return   [
    'name'=>'notifications',
    'description'=>'this api used to get notifications of user',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'page',
                'dataType'=>'int',
                'validation'=>'required min:0 ',
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'notifications'=>'<a href="#notification">notification</a>',

            ],
        ],
    ]
];
