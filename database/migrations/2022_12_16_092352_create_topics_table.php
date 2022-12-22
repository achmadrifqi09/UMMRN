<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_student')->nullable();
            $table->foreignId('id_researcher');
            $table->foreignId('id_community');
            $table->text('message');  
            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('topics');
    }
};
