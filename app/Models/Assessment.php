<?php

namespace App\Models;

use App\Enums\AssessmentLifecycleStatus;
use App\Enums\RiskResponseLifecycleStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lifecycle_status',

        'vulnerability_id',
        'company_id',
        'system_group_id',
        'asset_id',

        'risk_response_name',
        'risk_response_lifecycle_status',
        'risk_response_created',
    ];

    
    public function vulnerability(): BelongsTo
    {
        return $this->belongsTo(Vulnerability::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function system_group(): BelongsTo
    {
        return $this->belongsTo(SystemGroup::class);
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
        
    protected function lifecycle_status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => AssessmentLifecycleStatus::from($value),
            set: fn (AssessmentLifecycleStatus $status) => $status->value,
        );
    }

    protected function risk_response_lifecycle_status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => RiskResponseLifecycleStatus::from($value),
            set: fn (RiskResponseLifecycleStatus $status) => $status->value,
        );
    }
   
}
