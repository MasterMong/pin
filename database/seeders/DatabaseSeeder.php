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
        // init
        $jsonRegions = json_decode(File::get(base_path('data/dataRegions.json')), true);
        foreach ($jsonRegions as $key => $value) {
            self::createIfEmpty($value, 'regions');
        }
        $jsonInspection = json_decode(File::get(base_path('data/dataInspection.json')), true);
        foreach ($jsonInspection as $key => $value) {
            self::createIfEmpty($value, 'inspection_areas');
        }
        $jsonProvince = json_decode(File::get(base_path('data/dataProvinces.json')), true);
        foreach ($jsonProvince as $key => $value) {
            self::createIfEmpty($value, 'provinces');
        }
        $jsonDistricts = json_decode(File::get(base_path('data/dataDistricts.json')), true);
        foreach ($jsonDistricts as $key => $value) {
            self::createIfEmpty($value, 'districts');
        }
        $jsonAreaTypes = json_decode(File::get(base_path('data/areaType.json')), true);
        foreach ($jsonAreaTypes as $key => $value) {
            self::createIfEmpty($value, 'area_types');
        }
        $jsonAreas = json_decode(File::get(base_path('data/areaLists.json')), true);
        foreach ($jsonAreas as $key => $value) {
            self::createIfEmpty($value, 'areas', 'code');
        }
        $jsonBudgetYear = json_decode(File::get(base_path('data/budgetYear.json')), true);
        foreach ($jsonBudgetYear as $key => $value) {
            self::createIfEmpty($value, 'budget_years', 'id');
        }
        $jsonSettings = json_decode(File::get(base_path('data/settings.json')), true);
        foreach ($jsonSettings as $key => $value) {
            self::createIfEmpty($value, 'settings', 'key');
        }
        $jsonAttchmentType = json_decode(File::get(base_path('data/attchmentTypes.json')), true);
        foreach ($jsonAttchmentType as $key => $value) {
            self::createIfEmpty($value, 'area_attchment_types', 'name');
        }

        // user

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
        $adminUser = User::where('email', Env('ADMIN_EMAIL', 'admin@admin.com'))->first();
        $adminRole = Role::where('slug', 'admin')->first();

        $exitsRole = DB::table('role_users')->where('user_id', $adminUser->id)->where('role_id', $adminRole->id)->get();
        if (count($exitsRole) == 0) {
            DB::table('role_users')->insert([
                'user_id' => $adminUser->id,
                'role_id' => $adminRole->id,
            ]);
        }
        $jsonUsers = json_decode(File::get(base_path('data/systemUsers.json')));
        foreach ($jsonUsers as $key => $value) {
            self::createUser($value);
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
        if (empty(User::where('email', $data->email)->first())) {
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'area_id' => $data->area_id,
                'password' => Hash::make($data->password),
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

    public static function createIfEmpty($data, $table, $key = 'id')
    {
        $exits = DB::table($table)->where($key, $data[$key])->first();
        $data['created_at'] = now();
        $data['updated_at'] = now();
        if (empty($exits)) {
            $keys = array_keys($data);
            foreach ($keys as $i => $key) {
                $data[$key] = is_array($data[$key]) == true ? json_encode($data[$key]) : $data[$key];
            }
            DB::table($table)->insert($data);
        }
    }
}
