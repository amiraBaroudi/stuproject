<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    // تحديد اسم الجدول في قاعدة البيانات إذا لم يكن مطابقًا لاسم الـ Model بصيغة الجمع
    protected $table = 'vehicles';

    // تحديد المفتاح الأساسي إذا كان مختلفًا عن `id`
    protected $primaryKey = 'vehicles_id';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'driver_id',
        'vehicles_number',
        'capacity',
    ];

    // تحديد الحقول التي لا يمكن تعبئتها
    protected $guarded = [];

    // علاقات مع Models أخرى
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'driver_id');
    }
}
