<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressChange extends Model
{
    use HasFactory;
    protected $fillable = [

        'country',
        'region',
        'zone',
        'woreda',
        'kebele',
        'district',
        'phone_no',
        'po_box',
        'email',
        'cso_file',
        'send_date',
        'cso_id',
        'service_id',

    ];

    public function cso()
    {
        return $this->belongsTo(Cso::class, 'cso_id', 'id');
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
