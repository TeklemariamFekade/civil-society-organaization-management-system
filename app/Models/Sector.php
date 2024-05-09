<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_name',
        'sub_sector_name',
    ];

    public function csos()
    {
        return $this->hasMany(CSO::class);
    }
}
