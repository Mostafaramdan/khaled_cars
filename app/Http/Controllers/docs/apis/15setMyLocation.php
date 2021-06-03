<?php
return
[
    'name'=>'setMyLocation',
    'description'=>'this api used to set current location of user .',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'location',
                'dataType'=>'location object',
                'validation'=>'required',
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
