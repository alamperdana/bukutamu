<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $admin = User::create([
            'name' => 'administrator',
            'username' => 'admin',
            'email' => 'perdana.alam@gmail.com',
            'password' => bcrypt('Jangandibuka'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $admin->assignRole('super admin');
        
        $operator = User::create([
            'name' => 'Operator PBJAP',
            'username' => 'op_pbjap',
            'email' => 'op_pbjap@gmail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $operator->assignRole('operator');
        
        $user = User::create([
            'name' => 'PBJAP',
            'username' => 'pbjap',
            'email' => 'pbjap@gmail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $user->assignRole('operator');
    }
}
