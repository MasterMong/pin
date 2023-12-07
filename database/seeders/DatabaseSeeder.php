<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Orchid\Platform\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::createAdmin(Env('ADMIN_NAME', 'admin'), Env('ADMIN_EMAIL', 'admin@admin.com'), Env('ADMIN_PASSWORD', 'password'));
        // Role::create([
        //     'slug' => 'admin',
        //     'name' => 'ผู้ดูแลระบบ',
        //     'permissions' => '',
        // ]);
        // Role::create([
        //     'slug' => 'area',
        //     'name' => 'สพท',
        //     'permissions' => '',
        // ]);
        // Role::create([
        //     'slug' => 'eva',
        //     'name' => 'สตผ',
        //     'permissions' => '',
        // ]);
        // Role::create([
        //     'slug' => 'manager',
        //     'name' => 'ผู้บริหาร',
        //     'permissions' => '',
        // ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
