<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Env;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::createAdmin(Env('ADMIN_NAME', 'admin'), Env('ADMIN_EMAIL', 'admin@admin.com'), Env('ADMIN_PASSWORD', 'password'));
    }
}
