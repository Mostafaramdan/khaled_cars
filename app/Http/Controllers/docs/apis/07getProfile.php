<?php
return
[
    'name'=>'getProfile',
    'description'=>'this api used to get info of user\'s profile',
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
                'user'=>'<a href="#user">user</a>',
            ],
        ],
    ]
];
