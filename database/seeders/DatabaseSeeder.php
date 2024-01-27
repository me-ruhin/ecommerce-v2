<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\User::create([
        //     "name" => "test",
        //     "email" => "superadmin@gmail.com",
        //     "password" => 123456,
        // ]);

        $permissions = [
            "category.create",
            "category.view",
            "category.update",
            "category.delete",
            "unit.create",
            "unit.view",
            "unit.update",
            "unit.delete",
        ];

        array_map(function ($pemrission) {
            return [
                'name' => $pemrission,
                'age' => 10
            ];
        }, $permissions);
        //

        $permissions = collect($permissions)->map(function ($premission) {
            return [
                "name" => $premission,
                "guard_name" => 'web'
            ];
        });

        Permission::insert($permissions->toArray());
        $role = Role::create(["name" => "Super Admin"]);
        $role->givePermissionTo(Permission::all());
        Role::create(["name" => "Admin"])->givePermissionTo([
            "category.create",
            "category.view",
            "category.update",
        ]);
        User::find(1)->assignRole(["Super Admin", "Admin", "Editor"]);
        User::find(2)->assignRole("Admin");

        // permission -> Role->users
    }
}
