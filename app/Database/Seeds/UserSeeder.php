<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Admin John Smith',
                'email' => 'admin@sanmiguelhms.com',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'department' => 'Administration',
                'status' => 'Active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Admin User',
                'email' => 'nagisa2005@gmail.com',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'department' => 'Administration',
                'status' => 'Active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('users')->insertBatch($data);

        echo "UserSeeder completed successfully!\n";
        echo "Created " . count($data) . " admin users.\n";
        echo "Admin Login 1: admin@sanmiguelhms.com\n";
        echo "Admin Login 2: nagisa2005@gmail.com\n";
        echo "Password: admin123\n";
        echo "Role: admin\n";
    }
}
