<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    //protected $connection = 'pgsql_store';

    protected $fillable = [
        'id',     
        'uuid',     
        'name',     
        'description'     
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [ /* 'field_name' => 'field_type' */ ];
    
        
    protected static function newFactory()
    {
    //    return \Database\Factories\WarehouseFactory::new();
    }
}
