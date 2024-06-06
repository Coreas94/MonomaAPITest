<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'manager_user',
            'role' => 'manager',
            'password' => "manager123"
        ]);

        User::factory()->create([
            'username' => 'agent_user',
            'role' => 'agent',
            'password' => "agent123"
        ]);
    }
}
