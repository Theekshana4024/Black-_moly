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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table -> string('title');
            $table -> string('slug');
            $table ->  year('year');
            $table -> decimal('price',12,2);
            $table -> decimal('mileage',10,2);
            $table -> enum('fuel_type',['diesel','petrol','electric']);
            $table -> enum('transmission',['auto','manual']);
            $table -> enum('condition',['new','used','pre-owned']);
            $table -> text('location');
            $table -> text('description');
            $table -> enum('status',['available','sold','pending'])-> default('pending');
            $table -> unsignedBigInteger('model_id');
            $table -> unsignedBigInteger('user_id');


            $table -> foreign('model_id')->references('id')->on('models');
            $table -> foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
