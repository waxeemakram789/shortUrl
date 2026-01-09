<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class SuperAdminSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
            INSERT INTO roles (name, created_at, updated_at) VALUES
            ('SuperAdmin', NOW(), NOW()),
            ('Admin', NOW(), NOW()),
            ('Member', NOW(), NOW()),
            ('Sales', NOW(), NOW()),
            ('Manager', NOW(), NOW())
        ");

        DB::statement("
            INSERT INTO users (name, email, password, role_id, created_at, updated_at)
            VALUES (
                'Super Admin',
                'superadmin@example.com',
                '".Hash::make('password')."',
                (SELECT id FROM roles WHERE name = 'SuperAdmin'),
                NOW(),
                NOW()
            )
        ");
    }
}
