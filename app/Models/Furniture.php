<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Furniture extends Model
{
    use HasFactory;

    protected $table = 'furniture';
    protected $primaryKey = 'furniture_id';
    protected $fillable = [
        'name',
        'size',
        'type',
    ];

    // علاقة one-to-many مع orders
    // public function orders(): HasMany
    // {
    //     return $this->hasMany(Order::class, 'furniture_id', 'furniture_id');
    // }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

