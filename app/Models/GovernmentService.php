<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GovernmentService extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'department_id',
        'sub_department_id',
        'gose_num',
        'gose_save',
        'gose_date',
        'user_id',
        'position_id',
        'gose_category',
        'gose_inout_province',
        'gose_withdraw',
        'gose_withdraw_na',
        'gose_withdraw_allowance',
        'gose_withdraw_rest',
        'gose_withdray_other',
        'gose_date_start',
        'gose_time_start',
        'gose_date_end',
        'gose_time_end',
        'gose_num_day',
        'gose_vehicle',
        'gose_car_regis',
        'driver_id',
        'gose_about',
        'gose_place',
        'gose_district',
        'gose_province',
        'gose_traveler',
        'leader_id',
        'leader_comment',
        'leader_status',
        'leader_date',
        'commander_id',
        'commander_comment',
        'commander_status',
        'commander_date',
        'director_id',
        'director_comment',
        'director_status',
        'director_date',
        'gose_status',
        'gose_send',
        'gose_desc',
        'gose_file',
    ];

    public function department() {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function subDepartment() {
        return $this->belongsTo(Department::class,'sub_department_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function position() {
        return $this->belongsTo(Position::class,'position_id');
    }

    public function driver() {
        return $this->belongsTo(User::class,'driver_id');
    }

    public function leader() {
        return $this->belongsTo(User::class,'leader_id');
    }

    public function commander() {
        return $this->belongsTo(Commander::class,'commader_id');
    }

    public function director() {
        return $this->belongsTo(Director::class,'director_id');
    }

    public function travelers() {
        return $this->hasMany(GovernmentServiceItem::class,'government_service_id');
    }
}
