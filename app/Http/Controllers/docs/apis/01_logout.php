<?php
return
[
    'name'=>'logout',
    'description'=>'this api used to logout from the application',
    'notes'=>'after logout user can\'t do use any api and no notification can be received',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],

        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
            ],
        ],
    ]
];
