<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'furniture_id',
        'order_date',
        'pickup_address',
        'dropoff_address',
        'pickup_date',
        'pickup_time',
        'furniture_details',
        'status',
        'person_firstname',
        'person_lastname',
        'person_phone_number',
        'person_email',
    ];

    // علاقة مع نموذج User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // علاقة مع نموذج Furniture
    public function furniture()
    {
        return $this->hasMany(Furniture::class, 'order_id');
    }
 
}
