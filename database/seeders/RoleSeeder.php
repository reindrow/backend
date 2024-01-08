<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the roles table before seeding to avoid duplicate entries
        DB::table('roles')->delete();

        // Define the roles
        $roles = [
            ['name_role' => 'admin'],
            ['name_role' => 'server'],
            ['name_role' => 'pengguna']
        ];

        // Insert roles into the table
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name_role' => $role['name_role']
            ]);
        }
    }
    }