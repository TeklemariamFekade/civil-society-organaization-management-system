<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model implements Authenticatable
{
    use HasFactory;

    protected $table = 'representatives';
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'photo'
    ];

    public function getAuthIdentifierName()
    {
        return 'id';
    }
    public function cso()
    {
        return $this->belongsTo(CSO::class);
    }


    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
