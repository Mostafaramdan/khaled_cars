<?php
return
[
    'name'=>'getReviews',
    'description'=>'this api used to get all reviews ofra housing unit.',
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
                'description'=> 'get it from <a href="#getBid">getBid</a> '
            ],
            [
                'name'=>'page',
                'dataType'=>'int',
                'validation'=>'required min:0',
            ],
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'totalPages'=>'int',
                'review'=>' array of <a href="#review">review</a>'
            ],
        ],
    ]
];
