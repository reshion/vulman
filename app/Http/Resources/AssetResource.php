<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{

    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    // public $preserveKeys = true;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fqdn' => $this->fqdn,
            'unique_id' => $this->unique_id,
            'operating_system' => $this->operating_system,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'vulnerabilities' => new VulnerabilityPagingResource($this->whenLoaded('vulnerabilities'))
        ];
    }
}
