<?php
return
[
    [
        'name'=>'account',
        'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required'
            ],

            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'required'

            ],

            [
                'name'=>'user',
                'dataType'=>'<a href="#user">user</a>',
                'validation'=>'required'

            ],
        ]
    ],
    [
        'name'=>'user',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'
            ],

            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'currency',
                'dataType'=>'<a href="#currency">currency</a>',
                'validation'=>'optional'

            ],
            [
                'name'=>'images',
                'dataType'=>'<a href="#image">image</a>',
                'validation'=>'optional'

            ],
            [
                'name'=>'email',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'winnerBids',
                'dataType'=>'int',
                'validation'=>'required',
                'description'=>'count bidding whcich user won.'

            ],
            [
                'name'=>'currentOpenBids',
                'dataType'=>'int',
                'validation'=>'required',
                'description'=>'count bidding whcich still open.'

            ],
            [
                'name'=>'lang',
                'dataType'=>'string  => ar/en',
                'validation'=>'required'
            ],
        ]
    ],
    [
        'name'=>'location',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'optional'
            ],
            [
                'name'=>'longitude',
                'dataType'=>'float',
                'validation'=>'required'

            ],
            [
                'name'=>'latitude',
                'dataType'=>'float',
                'validation'=>'required'

            ],
            [
                'name'=>'address',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'description',
                'dataType'=>'string',
                'validation'=>'optional'

            ],
        ]
    ],
    [
        'name'=>'notification',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'type',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'content',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'order',
                'dataType'=>'<a href="#order">order</a>',
                'validation'=>'optional'

            ],
            [
                'name'=>'isSeen',
                'dataType'=>'boolean',
                'validation'=>'required'

            ],
            [
                'name'=>'createdAt',
                'dataType'=>'int',
                'validation'=>'required'

            ],
        ]
    ],
    [
        'name'=>'info',
        'params'=>
        [
            [
                'name'=>'aboutUs',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'policyTerms',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'privacy',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'emails',
                'dataType'=>'array of strings',
                'validation'=>'required'

            ],
            [
                'name'=>'phone',
                'dataType'=>'array of strings',
                'validation'=>'required'

            ],
        ]
    ],
    [
        'name'=>'bid',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required'
            ],
            [
                'name'=>'endAt',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'createdAt',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'type',
                'dataType'=>'string',
                'validation'=>'required'
            ],
            [
                'name'=>'minAuction',
                'dataType'=>'float',
                'validation'=>'required'
            ],
            [
                'name'=>'Insurance',
                'dataType'=>'float',
                'validation'=>'required'
            ],
            [
                'name'=>'isFav',
                'dataType'=>'boolean',
                'validation'=>'required'
            ],
            [
                'name'=>'product',
                'dataType'=>"<a href='#product'>product</a>",
                'validation'=>'required'
            ],
            [
                'name'=>'biddersCount',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'bidders',
                'dataType'=>"array of <a href='#bidder'>bidder</a>",
                'validation'=>'required'
            ],
            [
                'name'=>'rate',
                'dataType'=>"<a href='#rate'>rate</a>",
                'validation'=>'required'
            ],

        ]
    ],
    [
        'name'=>'bidder',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'price',
                'dataType'=>'float',
                'validation'=>'required'
            ],
            [
                'name'=>'createdAt',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'user',
                'dataType'=>"<a href='#user'>user</a>",
                'validation'=>'required'
            ],
        ]
    ],
    [
        'name'=>'country',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'cities',
                'dataType'=>'array of <a href="#city">city</a>',
                'validation'=>'optional'

            ],
        ]
    ],
    [
        'name'=>'city',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'districts',
                'dataType'=>'array of <a href="#district">district</a>',
                'validation'=>'optional'

            ],
        ]
    ],
    [
        'name'=>'model',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'model',
                'dataType'=>'string',
                'validation'=>'required'
            ],
        ]
    ],
    [
        'name'=>'modelYear',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'model_year',
                'dataType'=>'string',
                'validation'=>'required'
            ],
        ]
    ],
    [
        'name'=>'brand',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required'
            ],
            [
                'name'=>'image',
                'dataType'=>' <a href="#image">image</a>',
                'validation'=>'optional'
            ],
        ]
    ],
    [
        'name'=>'district',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required'

            ],
        ]
    ],
    [
        'name'=>'image',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'image',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'type',
                'dataType'=>'string',
                'validation'=>'required'

            ],
        ]
    ],
    [
        'name'=>'feature',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'image',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required'

            ],
        ]
    ],

    [
        'name'=>'product',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'description',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'image',
                'dataType'=>'array of <a href="#image">image</a>',
                'validation'=>'optional'

            ],
            [
                'name'=>'price',
                'dataType'=>'float',
                'validation'=>'required'
            ],
            [
                'name'=>'model',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'modelYear',
                'dataType'=>'string',
                'validation'=>'required'
            ],
            [
                'name'=>'brand',
                'dataType'=>"<a href='#brand'>brand</a>",
                'validation'=>'required'
            ],
            [
                'name'=>'model',
                'dataType'=>"<a href='#model'>model</a>",
                'validation'=>'required'
            ],
            [
                'name'=>'modelYear',
                'dataType'=>"<a href='#modelYear'>modelYear</a>",
                'validation'=>'required'
            ],
        ],
    ],
    [
        'name'=>'rate',
        'params'=>
        [
            [
                'name'=>'totalRate',
                'dataType'=>'float',
                'validation'=>'required'

            ],
            [
                'name'=>'one',
                'dataType'=>'float',
                'validation'=>'required',
                'description'=>'from 0 to 1'

            ],
            [
                'name'=>'two',
                'dataType'=>'float',
                'validation'=>'required',
                'description'=>'from 1.1 to 2'


            ],
            [
                'name'=>'three',
                'dataType'=>'float',
                'validation'=>'required',
                'description'=>'from 2.1 to 3'
            ],
            [
                'name'=>'four',
                'dataType'=>'float',
                'validation'=>'required',
                'description'=>'from 3.1 to 4'
            ],
            [
                'name'=>'five',
                'dataType'=>'float',
                'validation'=>'required',
                'description'=>'from 4.1 to 5'
            ],
        ],
    ],
    [
        'name'=>'order',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'startAt',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'endAt',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'status',
                'dataType'=>'string',
                'validation'=>'required'
            ],
            [
                'name'=>'price',
                'dataType'=>'float',
                'validation'=>'required'
            ],
            [
                'name'=>'priceAfterDiscount',
                'dataType'=>'float',
                'validation'=>'required',
            ],
            [
                'name'=>'roomsNum',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'adultNums',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'childrenNums',
                'dataType'=>'int',
                'validation'=>'required'
            ],
            [
                'name'=>'discount',
                'dataType'=>'float',
                'validation'=>'optional'
            ],
            [
                'name'=>'fees',
                'dataType'=>'float',
                'validation'=>'required'
            ],
            [
                'name'=>'total',
                'dataType'=>'float',
                'validation'=>'required',
            ],
            [
                'name'=>'carts',
                'dataType'=>'array of <a href="#cart">cart<a>',
                'validation'=>'required'

            ],
        ],
    ],
    [
        'name'=>'review',
        'params'=>
        [
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required'

            ],
            [
                'name'=>'rate',
                'dataType'=>'float',
                'validation'=>'required'

            ],
            [
                'name'=>'comment',
                'dataType'=>'string',
                'validation'=>'required'

            ],
            [
                'name'=>'user',
                'dataType'=>'<a href="#user">user<a>',
                'validation'=>'required'
            ],
        ]
    ],
    [
        'name'=>'productPrice',
        'params'=>
        [
            [
                'name'=>'start',
                'dataType'=>'int',
                'validation'=>'required',
                'description'=>'it will get prices which equal or greater than with this value'
            ],
            [
                'name'=>'end',
                'dataType'=>'int',
                'validation'=>'required',
                'description'=>'it will get prices which equal or smaller than with this value'
            ],
        ],
    ],
];
