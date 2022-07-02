<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDistrict extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'district_id',
        'sub_dist_name',
        'sub_desc',
    ];

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
}
