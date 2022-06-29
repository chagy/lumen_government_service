<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'province_id',
        'dist_name',
        'dist_desc',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id');
    }
}
