<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password',
        'u_prefix',
        'u_first_name',
        'u_last_name',
        'u_nick_name',
        'u_phone',
        'u_birthday',
        'u_workday',
        'u_officerday',
        'u_address',
        'sub_district_id',
        'district_id',
        'province_id',
        'u_zipcode',
        'position_id',
        'department_id',
        'sub_department_id',
        'leader_id',
        'commander_id',
        'director_id',
        'u_type'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    public function findForPassport($username) {
       return self::where('username', $username)->first(); // change column name whatever you use in credentials
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function subDepartment()
    {
        return $this->belongsTo(Department::class,'sub_department_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class,'position_id');
    }

    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class,'sub_district_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class,'leader_id');
    }

    public function commander()
    {
        return $this->belongsTo(User::class,'commander_id');
    }

    public function director()
    {
        return $this->belongsTo(User::class,'director_id');
    }
}
