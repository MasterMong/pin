<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Orchid\Platform\Models\Role;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::createAdmin(Env('ADMIN_NAME', 'admin'), Env('ADMIN_EMAIL', 'admin@admin.com'), Env('ADMIN_PASSWORD', 'password'));
        if (empty(User::where('email', Env('ADMIN_EMAIL', 'admin@admin.com'))->first())) {
            User::create([
                'name' => Env('ADMIN_NAME', 'admin'),
                'email' => Env('ADMIN_EMAIL', 'admin@admin.com'),
                'password' => Hash::make(Env('ADMIN_PASSWORD', 'password')),
                'email_verified_at' => now(),
            ]);
        }

        $jsonRoles = json_decode(File::get(base_path('data/systemRoles.json')), true);
        foreach ($jsonRoles as $key => $value) {
            self::createRole($value);
        }
        $jsonUsers = json_decode(File::get(base_path('data/systemUsers.json')));
        foreach ($jsonUsers as $key => $value) {
            self::createUser($value);
        }

        $adminUser = User::where('email', Env('ADMIN_EMAIL', 'admin@admin.com'))->first();
        $adminRole = Role::where('slug', 'admin')->first();

        $exitsRole = DB::table('role_users')->where('user_id', $adminUser->id)->where('role_id', $adminRole->id)->get();
        if (count($exitsRole) == 0) {
            DB::table('role_users')->insert([
                'user_id' => $adminUser->id,
                'role_id' => $adminRole->id,
            ]);
        }
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    public static function createRole($data)
    {
        if (empty(Role::where('slug', $data['slug'])->first())) {
            Role::create($data);
        }
    }

    public static function createUser($data)
    {
        $exitsUser = User::where('email', $data->email)->first();
        if (empty(User::where('email', $data->email)->first())) {
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => $data->password,
                'email_verified_at' => now(),
            ]);
            $role = Role::where('slug', $data->role)->first();
            if (!empty($role)) {
                $exitsRole = DB::table('role_users')
                    ->where('user_id', $user->id)
                    ->where('role_id', $role->id)
                    ->get();
                if (count($exitsRole) == 0) {
                    DB::table('role_users')->insert([
                        'user_id' => $user->id,
                        'role_id' => $role->id,
                    ]);
                }
            }
        }
    }
}
