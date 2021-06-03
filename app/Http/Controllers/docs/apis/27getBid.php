<?php
return
[
    'name'=>'getBid',
    'description'=>'this api used to get all info of a bid. to display it in it\'s profile ',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required min:9 max:15',
            ],
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required',
                'description'=> 'get it from <a href="#getBids">getBids</a>'
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'bids'=>'array of <a href="#bid">bid</a>'
            ],
        ],

    ]
];
