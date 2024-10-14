<?php

namespace App\Models;

use App\Enums\AssessmentLifecycleStatus;
use App\Enums\AssessmentTreatment;
use App\Enums\RiskResponseLifecycleStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'note',
        'lifecycle_status',

        'vulnerability_id',
        'company_id',
        'system_group_id',
        'asset_id',

        'risk_response_name',
        'risk_response_lifecycle_status',
        'risk_response_created',

        'company_ref_id',
        'treatment',
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

    public function company_ref(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected function treatment(): Attribute 
    {
        return Attribute::make(
            get: fn ($value) => AssessmentTreatment::from($value),
            set: fn ($value) => is_string($value) ? AssessmentTreatment::from($value)->value : $value->value,
        );
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
