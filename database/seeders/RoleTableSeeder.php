<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Create Admin Role
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo('dashboard');
        $admin->givePermissionTo('ticket-list');
        $admin->givePermissionTo('ticket-update');
        $admin->givePermissionTo('ticket-delete');
        //  Create Customer Role
        $customer = Role::create(['name' => 'Customer']);
        $customer->givePermissionTo('dashboard');
        $customer->givePermissionTo('ticket-create');
        $customer->givePermissionTo('ticket-list');
        $customer->givePermissionTo('ticket-view');

    }
}
