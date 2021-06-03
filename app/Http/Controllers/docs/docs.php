<?php
$myfiles = scandir(dirname(__FILE__).'/apis');
$count=2; $apis=[];
foreach($myfiles as $file){
    if($count < count($myfiles))
        $apis[]=include 'apis/'.$myfiles[$count++] ;
}
return
[
    'name'=>'hababkom',
    'description'=>'this appliction is similar to booking.com',
    'baseUrl'=>Request()->root().'api/',
    'apis'=>$apis
];
