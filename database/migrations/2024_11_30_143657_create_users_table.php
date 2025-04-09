<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Уникальный идентификатор
            $table->string('name'); // Имя пользователя
            $table->string('email')->unique(); // Уникальный email
            $table->string('password'); // Пароль
            $table->string('role')->default('client'); // Роль (по умолчанию клиент)
            $table->string('profile_foto')->nullable(); // Фото профиля
            $table->string('many')->nullable();
            $table->timestamp('email_verified_at')->nullable(); // Время подтверждения email
            $table->rememberToken(); // Токен для запоминания сессий
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
