<?php
return
[
    'name'=>'search',
    'description'=>'this api used search for bids',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'search',
                'dataType'=>'string',
                'validation'=>'required min:1 ',
            ],
            [
                'name'=>'brandId',
                'dataType'=>'int',
                'validation'=>'optional ',
                'description'=> 'get it from <a href="#getBrands">getBrands</a> '
            ],
            [
                'name'=>'productPrice',
                'dataType'=>'<a href="#productPrice">productPrice</a>',
                'validation'=>'optional ',
            ],
            [
                'name'=>'rate',
                'dataType'=>'int',
                'validation'=>'optional min:0 max:5',
            ],
            [
                'name'=>'location',
                'dataType'=>'<a href="#location">location</a>',
                'validation'=>'optional',
            ],
            [
                'name'=>'model',
                'dataType'=>'string',
                'validation'=>'optional',
            ],
            [
                'name'=>'modelYear',
                'dataType'=>'string',
                'validation'=>'optional',
            ],
            [
                'name'=>'model',
                'dataType'=>'string',
                'validation'=>'optional',
            ],

            [
                'name'=>'featureIds',
                'dataType'=>'array of int ',
                'validation'=>'optional',
                'description'=> 'get it from <a href="#getFeatures">getFeatures</a> '
            ],
            [
                'name'=>'type',
                'dataType'=>'string',
                'validation'=>'optional',
                'description'=> 'it can be open or close '
            ],
            [
                'name'=>'carStatus',
                'dataType'=>'string',
                'validation'=>'optional',
                'description'=> 'it can be new , antique , rare , slight_damage ,damage '
            ],

            [
                'name'=>'page',
                'dataType'=>'int',
                'validation'=>'required min:0',
            ],
            [
                'name'=>'sortBy',
                'dataType'=>'string',
                'validation'=>'optional',
                'description'=>'string should be (rate) , (productPrice) or (bidrice)',
            ],
            [
                'name'=>'sortType',
                'dataType'=>'string',
                'validation'=>'optional',
                'description'=>'string should be (AES) or (DESC)',
            ],

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
