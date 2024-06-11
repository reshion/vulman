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

    public function system_groups(): BelongsToMany
    {
        return $this->belongsToMany(Systemgroup::class);
    }

    public function vulnerabilities(): BelongsToMany
    {
        return $this->belongsToMany(Vulnerability::class, 'asset_vulnerabilities')
                    ->withPivot('scan_import_job_id')
                    ->withTimestamps();
    }
}
