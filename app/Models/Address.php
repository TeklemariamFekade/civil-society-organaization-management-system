<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_of_work',
        'country_of_origin',
        'country',
        'region',
        'zone',
        'woreda',
        'district',
        'kebele',
        'phone_no',
        'email',
        'po_box',
        'cso_id',
    ];

    public function cso()
    {
        return $this->belongsTo(CSO::class, 'cso_id', 'id');
    }
}
