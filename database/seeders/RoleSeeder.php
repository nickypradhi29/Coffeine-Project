<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'kasir', 'member'] as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        User::all()->each(function (User $user) {
            if ($user->role) {
                $user->syncRoles([$user->role]);
            }
        });
    }
}