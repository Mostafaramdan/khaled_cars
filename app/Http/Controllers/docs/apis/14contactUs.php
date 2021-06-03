<?php
return [
    'name'=>'contactUs',
    'description'=>'this api used to send message to admins of application',
    'notes'=>'if user is logged you should send apiToken. <br>
             if user is not logged  you should send phone and name . ',
    'params'=>
        [
            [
                'name'=>'apiToken',
                'dataType'=>'string',
                'validation'=>'optional',
            ],
            [
                'name'=>'name',
                'dataType'=>'string',
                'validation'=>'optional min:3 max:30',
            ],
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'optional min:3 max:30',
            ],
            [
                'name'=>'message',
                'dataType'=>'string',
                'validation'=>'required min:3',
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
            ],
        ],
    ]
];
