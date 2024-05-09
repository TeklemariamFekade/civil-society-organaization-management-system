<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support_Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'send_date',
        'cso_id',
        'service_id',
        'cso_file'
    ];

    public function cso()
    {
        return $this->belongsTo(CSO::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function notifications()
    {
        return $this->hasOne(Notification::class);
    }
}
