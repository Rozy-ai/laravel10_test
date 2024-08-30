<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class ImportUsersTest extends TestCase
{
    use RefreshDatabase;

    public function testImportUsers()
    {
        // Создание временного CSV файла
        $csvFile = storage_path('app/test_users.csv');
        file_put_contents($csvFile, "name,email,password\nTest User,test@example.com,password123");

        // Запуск команды импорта
        Artisan::call('users:import', ['file' => $csvFile]);

        // Проверка на наличие пользователя в базе данных
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }
}
