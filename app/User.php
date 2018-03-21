<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const VERIFIED_USER = '1';
    const NO_VERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    public $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    public function setNameAttribute( $value )
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function getNameAttribute( $value )
    {
        return ucwords($value);
    }

    public function setEmailAttribute( $value )
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }

    protected function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }

    protected function generateVerificationToken()
    {
        return str_random(40);
    }
}