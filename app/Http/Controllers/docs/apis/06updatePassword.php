<?php
return
[
    'name'=>'updatePassword',
    'description'=>'this api used to update password of user\'s account',
    'notes'=>'note that <br> the difference between updatePassword and changePassword that <br>
        <b>changePassword</b> used to when user forget password , and it need first validate code which sent after forget password<br>
        <b>changePassword just used to  update current password , to use it , user must be logged</b>
    ',
    'params'=>
        [
            [
                'name'=>'phone',
                'dataType'=>'string',
                'validation'=>'required min:9 max:15',
            ],
            [
                'name'=>'oldPassword',
                'dataType'=>'string',
                'validation'=>'required min:6 max:20',
            ],
            [
                'name'=>'newPassword',
                'dataType'=>'string',
                'validation'=>'required min:6 max:20',
            ]
        ],
    'response'=>[
        [
            'status'=>200,
            'params'=>[
            ],
        ],
        [
            'status'=>414,
            'params'=>[
                'message'=>'old pasword is incorrect'
            ],
        ],
    ]
];
