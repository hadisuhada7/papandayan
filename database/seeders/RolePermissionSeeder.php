<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            'manage company statistics',
            'manage testimonials',
            'manage our managements',
            'manage company abouts',
            'manage articles',
            'manage hero sections',
            'manage track records',
            'manage company profiles',
            'manage organization structures',
            'manage questions',
            'manage services',
            'manage careers',
            'manage career applicants',
            'manage experienced applicants',
            'manage contacts',
            'manage products',
            'manage coverage areas',
            'manage galleries',
            'manage corporate socials',
            'manage initiatives',
            'manage safety managements',
            'manage document reports',
            'manage annual reports',
            'manage financial statements',
            'manage investor presentations',
            'manage stock information',
            'manage shareholders',
            'manage menu navigations',
            'manage menu groups',
            'manage tickets',
            'manage email logs',
            'manage email configs',
            'manage download logs',
        ];

        foreach($permission as $permission){
            Permission::firstOrCreate(
                [
                    'name' => $permission
                ]
            );
        }

        $designManagerRole = Role::firstOrCreate([
            'name' => 'designer_manager'
        ]);

        $designManagerPermissions = [
            'manage company statistics',
            'manage testimonials',
            'manage our managements',
            'manage company abouts',
            'manage articles',
            'manage hero sections',
            'manage track records',
            'manage company profiles',
            'manage organization structures',
            'manage questions',
            'manage services',
            'manage careers',
            'manage career applicants',
            'manage experienced applicants',
            'manage contacts',
            'manage products',
            'manage coverage areas',
            'manage galleries',
            'manage corporate socials',
            'manage initiatives',
            'manage safety managements',
            'manage document reports',
            'manage annual reports',
            'manage financial statements',
            'manage investor presentations',
            'manage stock information',
            'manage shareholders',
            'manage menu navigations',
            'manage menu groups',
            'manage tickets',
            'manage email logs',
            'manage email configs',
            'manage download logs',
        ];

        $designManagerRole->syncPermissions($designManagerPermissions);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@papandayan.co.id',
            'password' => bcrypt('papandayan@2025')
        ]);

        $user->assignRole($superAdminRole);
    }
}
