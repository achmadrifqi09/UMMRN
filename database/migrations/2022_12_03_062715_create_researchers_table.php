<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('researchers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('interest');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('role', ['Researcher', 'Super Researcher'])->default('Researcher');
            $table->enum('status', ['Non Active', 'Active']);
            $table->string('otp')->nullable(); 
            $table->timestamp('otp_expired')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('researcher');
    }
};
