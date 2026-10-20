<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateAdminUser extends Command
{
    protected $signature = 'uraz:admin {email=admin@urazminingtrading.com} {--name=Admin}';

    protected $description = 'Create (or reset) the admin user with a freshly generated password, printed once to this console only';

    public function handle(): int
    {
        $email = $this->argument('email');
        $password = Str::password(16);

        User::updateOrCreate(['email' => $email], [
            'name'              => $this->option('name'),
            'password'          => $password,
            'role'              => 'admin',
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);

        $this->newLine();
        $this->info('Admin user ready.');
        $this->line('  Email:    ' . $email);
        $this->line('  Password: ' . $password);
        $this->newLine();
        $this->warn('This password is shown only once and is not stored anywhere else. Change it after first login.');

        return self::SUCCESS;
    }
}
