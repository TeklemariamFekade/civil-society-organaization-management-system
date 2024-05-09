<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
    ];

    public function nameChange()
    {

        return $this->hasMany(NameChange::class);
    }

    public function addressChange()
    {

        return $this->hasMany(AddressChange::class);
    }
    public function supportLetters()
    {
        return $this->hasMany(Support_Letter::class);
    }
}
