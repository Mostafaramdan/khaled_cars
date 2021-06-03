<?php
return
[
    'name'=>'getOrderInfo',
    'description'=>'this api used to get all info of an order , to display it in it\'s profile',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'required',
            ],
            [
                'name'=>'id',
                'dataType'=>'int',
                'validation'=>'required',
                'description'=> 'get it from <a href="#getOrders">getOrders</a> '

            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'order'=>' <a href="#order">order</a>'
            ],
        ],
    ]
];
