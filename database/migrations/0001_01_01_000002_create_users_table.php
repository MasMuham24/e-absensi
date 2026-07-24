<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code', 20)->unique();
            $table->foreignId('departement_id')->nullable()->constrained('departemens')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('position_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->string('name', 100);
            $table->string('username', 50)->unique();
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'hr', 'employee'])->default('employee');
            $table->string('phone', 20)->nullable();
            $table->string('avatar')->nullable();
            $table->date('hire_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    } 

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
