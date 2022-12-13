<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('member_of_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_project');
            $table->foreignId('id_student');
            $table->string('portfolio');
            $table->enum('status', ['Accept', 'Reject', 'Pending'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('member_of_projects');
    }
};
