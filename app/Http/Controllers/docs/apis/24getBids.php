<?php
return
[
    'name'=>'getBids',
    'description'=>'this api used to get bids to user',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'brandId',
                'dataType'=>'int',
                'validation'=>'optional',
                'description'=>"get it from <a href='#getBrands'>getBrands</a>"
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
