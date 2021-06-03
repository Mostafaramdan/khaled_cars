<?php
return
[
    'name'=>'getMyLocation',
    'description'=>'this api used to get current location of user',
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
                'location'=>'<a href="#location">location</a>',
            ],
        ],
    ]
];
