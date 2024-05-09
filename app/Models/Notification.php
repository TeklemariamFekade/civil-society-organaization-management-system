<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'send_date',
        'title',
        'notification_detail',
        'status',
        'task_id',
        'cso_id',
        'name_changes_id',
        'user_id',
        'registration_id',
        'address_changes_id',
        'support_letter_id',
    ];
    public function cso()
    {
        return $this->belongsTo(CSO::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function nameChanges()
    {
        return $this->belongsTo(NameChange::class);
    }

    public function addressChanges()
    {
        return $this->belongsTo(AddressChange::class);
    }

    public function supportLetter()
    {
        return $this->belongsTo(Support_Letter::class);
    }
}
