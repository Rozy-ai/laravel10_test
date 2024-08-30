<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use League\Csv\Reader;

class ImportUsers extends Command
{
    protected $signature = 'users:import {file}';
    protected $description = 'Import users from a CSV file';

    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error('File not found.');
            return;
        }

        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0); // Устанавливаем заголовок

        foreach ($csv as $record) {
            User::create([
                'name' => $record['name'],
                'email' => $record['email'],
                'password' => Hash::make($record['password']),
            ]);
        }

        $this->info('Users imported successfully.');
    }
}
