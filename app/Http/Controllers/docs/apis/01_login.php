<?php
return
[
    'name'=>'login',
    'description'=>'this api used to login in the application',
    'notes'=> 'every login apiToken will be changed ',
    'params'=>
        [
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'required - min:9 - max:15',
            ],
            [
                'name'=>'password',
                'dataType'=>'string',
                'validation'=>'required - min:6 - max:20',
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
            'status'=>406,
            'params'=>[
                'message'=>'password is incorrect',
            ],
        ],
    ]
];
