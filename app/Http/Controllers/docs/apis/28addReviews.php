<?php
return
[
    'name'=>'addReviews',
    'description'=>'this api used to rate a bid',
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
                'validation'=>'required min:0 ',
                'description'=> 'get it from <a href="#getBids">getBids</a>'

            ],
            [
                'name'=>'rate',
                'dataType'=>'float',
                'validation'=>'required min:0 max:5',
            ],
            [
                'name'=>'comment',
                'dataType'=>'string',
                'validation'=>'required min:3',
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'review'=>' <a href="#review">review</a>'
            ],
        ],

    ]
];
