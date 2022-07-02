<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDistrict extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'district_id',
        'subd_name',
        'subd_desc',
        'subd_zipcode'

    ];

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
}
