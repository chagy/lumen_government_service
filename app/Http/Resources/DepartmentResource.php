<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'id'            => $this->id,
            'parent'     => new DepartmentResource($this->parent),
            'depa_num'      => $this->depa_num,
            'depa_name'     => $this->depa_name,
            'depa_desc'     => $this->depa_desc,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'deleted_at'    => $this->deleted_at
        ];
    }
}
