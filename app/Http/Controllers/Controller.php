<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public static $itemPerPage=25;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function docs()
    {
        return view('docs',['docs'=>include 'docs/docs.php','resources'=>include 'docs/resources.php']);
    }

    public static function download()
    {
        $file_path = public_path('khaled cars.postman_collection.json');
        return response()->download( $file_path);
    }
}
