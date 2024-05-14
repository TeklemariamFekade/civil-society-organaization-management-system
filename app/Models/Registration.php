<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'send_date',
        'cso_id',
    ];

    public function cso()
    {
        return $this->belongsTo(CSO::class, 'cso_id', 'id');
    }



    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
