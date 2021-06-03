<?php
return  [
    'name'=>'updateProfile',
    'description'=>'this api used to update info of user\'s profile',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'optional min:3 max:30',
            ],
            [
                'name'=>'email',
                'dataType'=>'string unique',
                'validation'=>'optional',
                'description'=>'if you send it , you must use <a href=\'#validateCode\'>validateCode</a>'
            ],
            [
                'name'=>'phone',
                'dataType'=>'string unique',
                'validation'=>'optional min:3 max:30',
                'description'=>'if you send it , you must use <a href=\'#validateCode\'>validateCode</a>'
            ],
            [
                'name'=>'image',
                'dataType'=>'string',
                'validation'=>'optional',
            ],
            [
                'name'=>'cityId',
                'dataType'=>'int',
                'validation'=>'optional',
                'description'=>'get it from <a href=\'#getRegions\'>getRegions</a>'
            ],
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'account'=>'<a href="#account">account</a>',
            ],
        ],
        [
            'status'=>411,
            'params'=>[
                'message'=>'The email has already been taken.'
            ],
        ],
        [
            'status'=>410,
            'params'=>[
                'message'=>'The phone has already been taken.'
            ],
        ],
    ]
];
