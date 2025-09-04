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
      Schema::create('teachers', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->string('teacher_code', 20)->unique();
    $table->string('name', 100);
    $table->date('dob')->nullable();
    $table->boolean('gender')->nullable();
    $table->string('email', 100)->nullable();
    $table->string('phone', 20)->nullable();
    $table->unsignedBigInteger('department_id');
    $table->unsignedBigInteger('class_id');
    $table->string('specialization', 100)->nullable(); // thêm dòng này
    $table->tinyInteger('status')->default(1);
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
