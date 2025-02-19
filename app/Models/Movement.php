<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
//use Modules\Store\Database\Factories\StoreFactory;

class Movement extends Model
{
    use HasFactory;//, SoftDeletes;

    //protected $connection = 'pgsql_store';

    protected $fillable = [
        'id',     
        'type_id',     
        'date_time',     
        'subject',     
        'description',     
        'observation',     
        'close',     
        'support_type_id', 
        'support_number',
        'support_date',            
        'id_user_insert',     
        'id_user_update',  
        'user_edit_id',
        'editing'  
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [ 'date_time' => 'datetime', 'support_date' => 'datetime' ];    
        
    public function movementDetails()
    {        
        return $this->hasMany(\App\Models\MovementDetail::class);
    }
    
    /*protected static function newFactory()
    {
        return MovementFactory::new();
    }*/
}
