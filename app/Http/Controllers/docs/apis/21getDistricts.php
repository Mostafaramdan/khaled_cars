<?php
return
[
    'name'=>'getDistricts',
    'description'=>'this api used to get districts in the application',
    'params'=>
        [
            [
                'name'=>'districtId',
                'dataType'=>'int',
                'validation'=>"get from <a href='#getCountries'></a> ",
            ],

        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'districts'=>'array of <a href="#district">district</a>'
            ],
        ],
    ]
];
