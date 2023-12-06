<?php

use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles
        $role = Role::create(['name' => 'developers']);
        $role = Role::create(['name' => 'administrators']);      // jellemzoen a fejesek
        $role = Role::create(['name' => 'sales-sr']);           // tipikusan RealHome alkalmazottak
        $role = Role::create(['name' => 'sales-jr']);
        $role = Role::create(['name' => 'clients']);             // regisztralt felhasznalok: ugyfelek
    }
}
