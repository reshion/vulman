<?php

namespace App\Models;

use App\Enums\RiskResponseLifecycleStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiskResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'assessment_id',
        'name',
        'created',
        'lifecycle_status'
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    protected function lifecycle_status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => RiskResponseLifecycleStatus::from($value),
            set: fn (RiskResponseLifecycleStatus $status) => $status->value,
        );
    }
}
