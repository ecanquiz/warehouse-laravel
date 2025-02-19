<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MovementDetail extends Model
{
    use HasFactory;//, SoftDeletes;

    //protected $connection = 'pgsql_store';

    protected $fillable = [
        //'id',     
        'movement_id',     
        'article_id',     
        'quantity',     
        'close',     
        'user_insert_id',    
        'user_update_id'     
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [ /* 'field_name' => 'field_type' */ ];
    
    public function movement()
    {
        return $this->belongsTo(\App\Models\Movement::class);
    }


    /*protected static function newFactory()
    {
        return \Modules\Store\Database\Factories\MovementDetailFactory::new();
    }*/
}
