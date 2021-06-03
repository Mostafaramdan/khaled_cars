<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locations extends GeneralModel
{
    public static function createUpdate($params)
    {
        $record= isset($params["id"])? self::find($params["id"]) :new self();
        $record->longitude = isset($params["longitude"])? $params["longitude"]: $record->longitude;
        $record->latitude = isset($params["latitude"])? $params["latitude"]: $record->latitude;
        $record->address = isset($params["address"])? $params["address"]: $record->address;
        $record->save();
        return $record;
    }
}
