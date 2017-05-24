<?php

namespace Api\Users\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Api\Users\Models\Division;
use Api\Users\Models\Driver;
use Api\Users\Models\Trip;
use Api\Users\Models\Vehicle;

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
     * @param string $identifier username|email|phone
     * @return mixed
     */
    
    /** override the default email auth **/
    public function findForPassport($identifier) {
        return User::orWhere('email', $identifier)
                  ->orWhere('username', $identifier)
                  ->orWhere('phone_number', $identifier)
                  ->first();
    }

    /**
     * The relationship of users table
     * 1. Users.id --> drivers.user_id
     * 2. Users.division_id --> divisions.id
     * 3. Users.id --> trips.driver_id
     */
    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function drivers()
    {
        return $this->belongsTo(Driver::class,'id', 'user_id');
    }

    public function trips()
    {
        return $this->belongsTo(Trip::class, 'id', 'passenger_id');
    }

    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class, 'id', 'driver_id');
    }
}
