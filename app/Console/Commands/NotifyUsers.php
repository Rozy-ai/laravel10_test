<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class NotifyUsers extends Command
{
    protected $signature = 'users:notify {role}';
    protected $description = 'Notify users with a specific role';

    public function handle()
    {
        $role = $this->argument('role');
        $users = User::where('role', $role)->get();

        foreach ($users as $user) {
            Queue::push(new UserNotification($user));
        }

        $this->info('Notification queued for users with role: ' . $role);
    }
}
