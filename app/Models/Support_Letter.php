<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support_Letter extends Model
{
    use HasFactory;

    protected $table = 'support_letters';
    protected $fillable = [
        'send_date',
        'cso_file',
        'cso_id',
        'service_id',

    ];

    public function cso()
    {
        return $this->belongsTo(CSO::class, 'cso_id', 'id');
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
