<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class User extends Model
// {
//     use HasFactory;

//     // تحديد اسم الجدول في قاعدة البيانات إذا لم يكن مطابقًا لاسم الـ Model بصيغة الجمع
//     protected $table = 'users';

//     // تحديد الحقول القابلة للتعبئة
//     protected $fillable = [
//         'name',
//         'password',
//     ];

//     // تحديد الحقول التي لا يمكن تعبئتها
//     protected $guarded = [];

//     // لإضافة دعم للـ التشفير
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     // تعريف العلاقة مع نموذج Order
//     public function orders()
//     {
//         return $this->hasMany(Order::class, 'customer_id', 'id');
//     }
// }

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable,HasRoles;
    


    // تحديد اسم الجدول في قاعدة البيانات
    protected $table = 'users';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
    ];

    // تحديد الحقول التي لا يمكن تعبئتها
    protected $guarded = [];

    // لإضافة دعم للـ التشفير
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // تحديد اسم العمود الأساسي
    protected $primaryKey = 'user_id';

    // تحديد نوع العمود الأساسي إذا لم يكن من نوع INT
    protected $keyType = 'int'; // إذا كان من نوع آخر، غيّره حسب الحاجة

    // إذا كان العمود الأساسي يتزايد تلقائيًا
    public $incrementing = true;

    // تعريف العلاقة مع نموذج Order
    public function orders()
    {
        // يحدد العلاقة بين المستخدم والطلبات
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

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
