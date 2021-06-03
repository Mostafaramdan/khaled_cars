<?php
return
[
    'name'=>'getMyBids',
    'description'=>'this api used to get user\'s bids',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'type',
                'dataType'=>'string',
                'validation'=>'optional',
                'description'=>"open , win , lose"
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
                'bids'=>'array of <a href="#bid">bid</a>'

            ],
        ],
    ]
];
