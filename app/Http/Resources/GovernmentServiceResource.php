<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GovernmentServiceResource extends JsonResource
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
            'id'                      => $this->id,
            'department'           => new DepartmentResource($this->department),
            'sub_department'       => new DepartmentResource($this->subDepartment),
            'gose_num'                => $this->gose_num,
            'gose_save'               => $this->gose_save,
            'gose_date'               => $this->gose_date,
            'user'                 => new UserResource($this->user),
            'position'             => new PositionResource($this->position),
            'gose_category'           => $this->gose_category,
            'gose_inout_province'     => $this->gose_inout_province,
            'gose_withdraw'           => $this->gose_withdraw,
            'gose_withdraw_na'        => $this->gose_withdraw_na,
            'gose_withdraw_allowance' => $this->gose_withdraw_allowance,
            'gose_withdraw_rest'      => $this->gose_withdraw_rest,
            'gose_withdray_other'     => $this->gose_withdray_other,
            'gose_date_start'         => $this->gose_date_start,
            'gose_time_start'         => $this->gose_time_start,
            'gose_date_end'           => $this->gose_date_end,
            'gose_time_end'           => $this->gose_time_end,
            'gose_num_day'            => $this->gose_num_day,
            'gose_vehicle'            => $this->gose_vehicle,
            'gose_car_regis'          => $this->gose_car_regis,
            'driver'               => new UserResource($this->driver),
            'gose_about'              => $this->gose_about,
            'gose_place'              => $this->gose_place,
            'gose_district'           => $this->gose_district,
            'gose_province'           => $this->gose_province,
            'gose_traveler'           => $this->gose_traveler,
            'leader'               => new UserResource($this->leader),
            'leader_comment'          => $this->leader_comment,
            'leader_status'           => $this->leader_status,
            'leader_date'             => $this->leader_date,
            'commander'            => new UserResource($this->commander),
            'commander_comment'       => $this->commander_comment,
            'commander_status'        => $this->commander_status,
            'commander_date'          => $this->commander_date,
            'director'             => new UserResource($this->director),
            'director_comment'        => $this->director_comment,
            'director_status'         => $this->director_status,
            'director_date'           => $this->director_date,
            'gose_status'             => $this->gose_status,
            'gose_send'               => $this->gose_send,
            'gose_desc'               => $this->gose_desc,
            'gose_file'               => $this->gose_file ? url('documents/'.$this->gose_file) : null,
            'created_at'              => $this->created_at,
            'updated_at'              => $this->updated_at,
            'deleted_at'              => $this->deleted_at,
            'travelers'                => GovernmentServiceItemResource::collection($this->travelers)
        ];
    }
}
