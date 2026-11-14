<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = config('admin.email');
        $password = config('admin.password');

        if (! is_string($email) || $email === '' || ! is_string($password) || $password === '') {
            return;
        }

        $admin = User::query()->firstOrNew(['email' => $email]);
        $admin->forceFill([
            'name' => config('admin.name', 'Store admin'),
            'password' => $password,
            'is_admin' => true,
        ])->save();
    }
}
