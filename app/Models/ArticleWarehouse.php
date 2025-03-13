<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ArticleWarehouseFactory;
use App\Models\Warehouse;

class ArticleWarehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'article_warehouse';

    protected $fillable = [
        'id',     
        'article_id',     
        'warehouse_uuid',     
        'stock_min',     
        'stock_max',     
        'status',     
        'id_user_insert',     
        'id_user_update' 
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [ /* 'field_name' => 'field_type' */ ];

    //protected $with = ['warehouse'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    } 
    
    protected static function newFactory()
    {
        return ArticleWarehouseFactory::new();
    }
}
