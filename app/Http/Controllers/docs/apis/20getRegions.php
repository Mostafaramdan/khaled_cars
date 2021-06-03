<?php
return
[
    'name'=>'getRegions',
    'description'=>'this api used to get regions in the application',
    'params'=>
        [

        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'countries'=>'array of <a href="#country">country</a>'
            ],
        ],
    ]
];
