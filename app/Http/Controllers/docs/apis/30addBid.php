<?php
return
[
    'name'=>'addBid',
    'description'=>'this api used to add bid .',
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
                'name'=>'price',
                'dataType'=>'float',
                'validation'=>'required',
                'description'=>'only total prices of housing unit which sent , don\'t calculate discount or fees'

            ],
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'bid'=>' <a href="#bid">bid</a>'
            ],
        ],
        [
            'status'=>412,
            'params'=>[
                "message"=> "you should pay insurance first ."
            ],
        ],
    ]
];
