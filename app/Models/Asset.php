<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'fqdn',
        'unique_id',
        'operating_system',
        'updated_at',
    ];
}
