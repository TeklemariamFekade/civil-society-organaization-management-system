<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSO extends Model
{
    use HasFactory;
    protected $table = 'csos';

    protected $fillable = [
        'english_name',
        'amharic_name',
        'date_of_established',
        'type',
        'category',
        'current_status',
        'approvalNumber',
        'cso_file',
        'status',
        'sector_id',
        'representative_id',
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
    public function representative()
    {
        return $this->hasOne(Representative::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'cso_id', 'id');
    }

    public function nameChange()
    {
        return $this->hasMany(NameChange::class, 'cso_id', 'id');
    }

    public function addresschange()
    {
        return $this->hasMany(AddressChange::class, 'cso_id', 'id');
    }
    public function registration()
    {
        return $this->hasMany(Registration::class, 'cso_id', 'id');
    }

    public function supportLetters()
    {
        return $this->hasMany(Support_Letter::class, 'cso_id', 'id');
    }

    public static function generateApprovalNumber()
    {
        do {
            $approvalNumber = rand(100000, 999999); // Generate a random number
        } while (self::where('approvalNumber', $approvalNumber)->exists());

        return $approvalNumber;
    }
}
