<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    public $timestamps = false , $with=['housing_unit'];
    protected $appends=['adult_nums','children_nums'];

    public static function createUpdate($params)
    {
        $record= isset($params['id'])? self::find($params['id']) :new self();
        $record->housing_units_id =isset($params['housing_units_id'])?$params['housing_units_id']: $record->housing_units_id;
        $record->orders_id =isset($params['orders_id'])?$params['orders_id']: $record->orders_id;
        $record->quantity =isset($params['quantity'])?$params['quantity']: $record->quantity;
        $record->price =isset($params['price'])?$params['price']: $record->price;
        $record->save();
        return $record;
    }
    public function housing_unit()
    {
        return $this->belongsTo(housing_units::class,'housing_units_id');
    }
    public function order()
    {
        return $this->belongsTo(orders::class,'orders_id');
    }
    function GetAdultNumsAttribute()
    {
        // return $this->housing_unit->
    }
    function GetChildrenNumsAttribute()
    {

    }
}
