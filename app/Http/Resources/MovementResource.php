<?php

namespace Modules\Store\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "type_id" => $this->type_id,
            "number" => $this->number,
            "date_time" => $this->date_time,
            "subject" => $this->subject,
            "description" => $this->description,
            "observation" => $this->observation,
            "close" => $this->close,
            "support_type_id" => $this->support_type_id,
            "support_number" => $this->support_number,
            "support_date" => $this->support_date
        ];
    }
}


