<?php

namespace App\Models;

use App\Enums\SystemGroupType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SystemGroup extends Model
{
    

    use HasFactory;
    protected $table = 'system_groups';
    protected $fillable = [
        'name',
        'company_id',
        'type'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class);
    }

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => SystemGroupType::from($value),
            set: fn (SystemGroupType $type) => $type->value,
        );
    }
}
