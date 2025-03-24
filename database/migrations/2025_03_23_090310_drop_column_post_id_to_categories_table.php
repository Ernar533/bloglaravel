<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Проверяем, поддерживает ли SQLite удаление столбца
        if (DB::getDriverName() === 'sqlite') {
            // Создаем новую таблицу без post_id
            Schema::create('categories_new', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->timestamps();
            });

            // Переносим данные
            DB::statement("INSERT INTO categories_new (id, title, created_at, updated_at)
                           SELECT id, title, created_at, updated_at FROM categories");

            // Удаляем старую таблицу
            Schema::dropIfExists('categories');

            // Переименовываем новую таблицу в categories
            Schema::rename('categories_new', 'categories');
        } else {
            // В других базах (MySQL, PostgreSQL) можно просто удалить колонку
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('post_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // Восстанавливаем post_id в SQLite через пересоздание таблицы
            Schema::create('categories_old', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->unsignedBigInteger('post_id')->nullable();
                $table->timestamps();
            });

            // Копируем данные обратно
            DB::statement("INSERT INTO categories_old (id, title, created_at, updated_at)
                           SELECT id, title, created_at, updated_at FROM categories");

            Schema::dropIfExists('categories');
            Schema::rename('categories_old', 'categories');
        } else {
            // Для MySQL/PostgreSQL можно просто добавить колонку обратно
            Schema::table('categories', function (Blueprint $table) {
                $table->unsignedBigInteger('post_id')->nullable();
            });
        }
    }
};
