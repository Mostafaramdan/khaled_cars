<?php
return
[
    'name'=>'getFeatures',
    'description'=>'this api used to get fatures in the application',
    'params'=>
        [


        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
                'features'=>'array of <a href="#feature">feature</a>'
            ],
        ],
    ]
];
