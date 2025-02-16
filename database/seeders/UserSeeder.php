<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method is responsible for seeding the database with initial user roles and permissions.
     * It creates permissions for the admin and staff roles, assigns those permissions to the roles,
     * and creates an admin user with specific permissions and roles.
     */
    public function run(): void
    {
        // Create permissions for the panel
        $permissionPanelDashboard = Permission::create(['name' => 'panel dashboard']);
        $permissionPanelUsers = Permission::create(['name' => 'panel users']);
        $permissionPanelEvents = Permission::create(['name' => 'panel events']);
        $permissionPanelPayments = Permission::create(['name' => 'panel payments']);

        // Create roles for admin, staff, and regular user
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);
        $userRole = Role::create(['name' => 'user']); // Role for regular users

        // Define permissions for the admin role
        $adminPermissions = [
            $permissionPanelDashboard,
            $permissionPanelUsers,
            $permissionPanelEvents,
            $permissionPanelPayments
        ];

        // Define permissions for the staff role
        $staffPermissions = [
            $permissionPanelDashboard,
            $permissionPanelEvents,
            $permissionPanelPayments
        ];

        // Define permissions for the user role
        $userPermissions = [
            $permissionPanelEvents // Regular users can only access events
        ];

        // Assign permissions to the admin role
        foreach ($adminPermissions as $permission) {
            $adminRole->givePermissionTo($permission);
            $permission->assignRole($adminRole);
        }

        // Assign permissions to the staff role
        foreach ($staffPermissions as $permission) {
            $staffRole->givePermissionTo($permission);
            $permission->assignRole($staffRole);
        }

        // Assign permissions to the user role
        foreach ($userPermissions as $permission) {
            $userRole->givePermissionTo($permission);
            $permission->assignRole($userRole);
        }

        // Create an admin user with specific credentials
        $admin = new User([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123') // Hash the password for security
        ]);
        // Assign the dashboard permission to the admin user
        $admin->givePermissionTo('panel dashboard');
        // Assign the admin role to the admin user
        $admin->assignRole('admin');

        // Create a staff user with specific credentials
        $staff = new User([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('staff123') // Hash the password for security
        ]);
        // Assign the staff role to the staff user
        $staff->assignRole('staff');

        // Create a regular user with specific credentials
        $user = new User([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123') // Hash the password for security
        ]);
        // Assign the user role to the regular user
        $user->assignRole('user');

        // Save the users to the database
        $admin->save();
        $staff->save();
        $user->save();

        // Create 10 additional users using the factory
        User::factory()->count(10)->create();
    }
}
