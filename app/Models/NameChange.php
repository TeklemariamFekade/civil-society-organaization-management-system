<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Namechange extends Model
{
    use HasFactory;
    protected $fillable = [


        'new_english_name',
        'new_amharic_name',
        'send_date',
        'cso_file',
        'cso_id',
        'service_id',

    ];

    public function cso()
    {
        return $this->belongsTo(CSO::class, 'cso_id', 'id');
    }
    public function notifications()
    {
        return $this->hasOne(Notification::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
