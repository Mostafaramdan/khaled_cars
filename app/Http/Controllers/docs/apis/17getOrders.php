<?php
return
[
    'name'=>'getOrders',
    'description'=>'this api used to get orders of the user',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required ',
            ],
            [
                'name'=>'status',
                'dataType'=>'array of strings',
                'validation'=>'required ',
                'description'=>'these strings in [waiting,coming,resident,finished,cancelled,refused]'
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'orders'=>'array of <a href="#order">order</a>'
            ],
        ],
    ]
];
