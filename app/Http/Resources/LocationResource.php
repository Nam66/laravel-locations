<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'latitude'   => $this->latitude,
            'longitude'  => $this->longitude,
            'status'     => $this->status,
            'edit_url'   => route('locations.edit', $this->resource),
            'delete_url' => route('locations.destroy', $this->resource),
        ];
    }
}
