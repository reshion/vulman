<?php

namespace App\Models;

use App\Enums\AssessmentLifecycleStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created',
        'lifecycle_status'
    ];

    protected function lifecycle_status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => AssessmentLifecycleStatus::from($value),
            set: fn (AssessmentLifecycleStatus $status) => $status->value,
        );
    }
   
}
