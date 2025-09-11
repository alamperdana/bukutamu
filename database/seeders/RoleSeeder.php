<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Role::create(['name' => 'super admin', 'created_at' => $now, 'updated_at' => $now]);
        Role::create(['name' => 'operator', 'created_at' => $now, 'updated_at' => $now]);
        Role::create(['name' => 'user', 'created_at' => $now, 'updated_at' => $now]);
    }
}
