<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contacts extends GeneralModel
{
    protected $table = 'contacts',$appends=['name'];
    protected $guarded = [];
    public $timestamps = ['created_at'];
    const UPDATED_AT   = null;

    public function user()
    {
        return $this->belongsTo(users::class,"users_id");
    }
    function GetNameAttribute()
    {
        return $this->user->name;
    }
}
