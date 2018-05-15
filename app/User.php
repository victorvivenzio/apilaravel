<?php

namespace App;

use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    protected $dates = ['deleted_at'];

    const VERIFIED_USER = '1';
    const NO_VERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    public $transformer = UserTransformer::class;

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
