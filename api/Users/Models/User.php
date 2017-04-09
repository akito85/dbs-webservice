<?php

namespace Api\Users\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'gender',
        'phone_number',
        'access_level',
        'status',
        'token',
        'requests',
        'division_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
  
    /**
     * Find the user identified by the given $identifier.
     *
     * @param $identifier username|email|phone
     * @return mixed
     */
    
    /** override the default email auth **/
    public function findForPassport($identifier) {
      return User::orWhere('email', $identifier)
                  ->orWhere('username', $identifier)
                  ->orWhere('phone_number', $identifier)
                  ->first();
    }
}
