<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Driver extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'drivers';
    protected $primaryKey = 'driver_id';

    protected $fillable = [
        'username',
        'license_number',
        'vehicle_type',
        'password',
        'availability',
    ];

    protected $guarded = [];

    // تهيئة علاقات مع Models أخرى
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'driver_id', 'driver_id');
    }

    // Implementing JWTSubject interface methods

    /**
     * Get the identifier that will be stored in the JWT subject claim.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
