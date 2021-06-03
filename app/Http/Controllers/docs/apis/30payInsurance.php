<?php
return
[
    'name'=>'payInsurance',
    'description'=>'this api used to pay insurrance to can add bid  .',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'bidId',
                'dataType'=>'int',
                'validation'=>'required',
                'description'=> 'get it from <a href="#getBids">getBids</a> or <a href="#getBid">getBid</a> '
            ],
            [
                'name'=>'image',
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
        [
            'status'=>201,
            'params'=>[
                'message'=>'you have been paid insurances succefully before'
            ],
        ],
        [
            'status'=>202,
            'params'=>[
                'message'=>'you have been paid insurances before, and Awaiting review '
            ],
        ],


    ]
];
