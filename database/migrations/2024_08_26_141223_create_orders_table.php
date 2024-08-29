<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('user_id')->constrained('users', 'user_id'); // تأكد من أن هذا يتطابق مع جدول `users`
            $table->date('order_date');
            $table->string('pickup_address');
            $table->string('dropoff_address');
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->text('furniture_details');
            $table->enum('status', ['pending', 'in transit', 'delivered']);
            $table->string('person_firstname');
            $table->string('person_lastname');
            $table->string('person_phone_number');
            $table->string('person_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
