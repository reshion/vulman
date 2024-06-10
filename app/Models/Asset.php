<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Asset extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'fqdn',
        'unique_id',
        'operating_system',
        'updated_at',
    ];

    public function systemgroups()
    {
        return $this->belongsToMany(Systemgroup::class);
    }

    public function vulnerabilities(): BelongsToMany
    {
        return $this->belongsToMany(Vulnerability::class, 'asset_vulnerability', 'asset_id', 'vulnerability_id')
        ->withPivot('timestamp') // zusätzliches Pivot-Feld
        ->withTimestamps();
    }
}
