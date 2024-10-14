<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'note' => $this->note,
            'created' => $this->created,
            'vulnerability_id' => $this->vulnerability_id,
            'company_id' => $this->company_id,
            'system_group_id' => $this->system_group_id,
            'asset_id' => $this->asset_id,
            'treatment' => $this->treatment,
            'lifecycle_status' => $this->lifecycle_status,
            'risk_response_name' => $this->risk_response_name,
            'risk_response_lifecycle_status' => $this->risk_response_lifecycle_status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
