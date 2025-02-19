<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\SoftDeletes;
// use Modules\Store\Database\Factories\DailyClosingFactory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DailyClosing extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'close_days';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): DailyClosingFactory
    // {
    //     // return DailyClosingFactory::new();
    // }
}
