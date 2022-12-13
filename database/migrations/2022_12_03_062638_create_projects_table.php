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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_researcher');
            $table->text('title');
            $table->integer('published_year');
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('available_member');
            $table->integer('total_member');
            $table->string('excerpt');
            $table->enum('status', ['Open', 'Active', 'Complated']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
