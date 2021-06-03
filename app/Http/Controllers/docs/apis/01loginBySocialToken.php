<?php
return
[
    'name'=>'loginBySocialToken',
    'description'=>'this api used to login by socialToken in the application',
    'notes'=> 'every login apiToken will be changed ',
    'params'=>
        [
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'optional - min:9 - max:15',
            ],
            [
                'name'=>'email',
                'dataType'=>'string',
                'validation'=>'optional - min:9 - max:15',
            ],
            [
                'name'=>'socialToken',
                'dataType'=>'string',
                'validation'=>'required',
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'account'=>'<a href="#account">account</a>'

            ],
        ]
    ]
];
