<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'username'          => $this->username,
            'u_prefix'          => $this->u_prefix,
            'u_first_name'      => $this->u_first_name,
            'u_last_name'       => $this->u_last_name,
            'u_nick_name'       => $this->u_nick_name,
            'u_phone'           => $this->u_phone,
            'u_birthday'        => $this->u_birthday,
            'u_workday'         => $this->u_workday,
            'u_officerday'      => $this->u_officerday,
            'u_address'         => $this->u_address,
            'sub_district'   => new SubDistrictResource($this->subDistrict),
            'district'       => new DistrictResource($this->district),
            'province'       => new ProvinceResource($this->province),
            'u_zipcode'         => $this->u_zipcode,
            'position'       => new PositionResource($this->position),
            'department'     => new DepartmentResource($this->department),
            'sub_department' => new DepartmentResource($this->subDepartment),
            'leader'         => new UserResource($this->leader),
            'commander'      => new UserResource($this->commander),
            'director'       => new UserResource($this->director),
            'u_type'            => $this->u_type,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'deleted_at'        => $this->deleted_at,
        ];
    }
}
