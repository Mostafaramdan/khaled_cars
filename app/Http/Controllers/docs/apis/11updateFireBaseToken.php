<?php
return [
    'name'=>'updateFireBaseToken',
    'description'=>'this api used to set or update fireBaseToken of user which used in push notifications',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'fireBaseToken',
                'dataType'=>'string',
                'validation'=>'required',
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'message'=>'fireBaseToken updated successfully'
            ],
        ]
    ]
];
