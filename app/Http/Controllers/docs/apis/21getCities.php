<?php
return
[
    'name'=>'getCities',
    'description'=>'this api used to get cities in the application',
    'params'=>
        [
            [
                'name'=>'countryId',
                'dataType'=>'int',
                'validation'=>"get from <a href='#getCountries'></a> ",
            ],
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'cities'=>'array of <a href="#country">country</a>'
            ],
        ],
    ]
];
