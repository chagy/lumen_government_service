<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'depa_num',
        'depa_name',
        'depa_desc',
    ];

    public function parent() {
        return $this->belongsTo(Department::class,'parent_id');
    }

    public function children() {
        return $this->hasMany(Department::class,'parent_id');
    }
}
