<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('curriculum_vitaes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_researcher');
            $table->text('education')->nullable();
            $table->text('skill')->nullable();
            $table->text('teaching')->nullable();
            $table->text('organizational')->nullable();
            $table->text('award')->nullable();
            $table->text('topic')->nullable();
            $table->text('publications')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculum_vitaes');
    }
};
