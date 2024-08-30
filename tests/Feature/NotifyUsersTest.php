<?php 
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Queue;

class NotifyUsersTest extends TestCase
{
    use RefreshDatabase;

    public function testNotifyUsers()
    {
        Queue::fake();

        // Создаем тестового пользователя
        User::create(['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'role' => 'admin']);

        // Запускаем команду уведомления Artisan::call('users:notify', ['role' => 'admin']);

        // Проверка на наличие задач в очереди
        Queue::assertPushed(UserNotification::class, 1);
    }
}
