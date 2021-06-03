<?php
return
[
    'name'=>'getCountries',
    'description'=>'this api used to get countries in the application',
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
