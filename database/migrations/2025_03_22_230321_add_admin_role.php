<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $role = Role::create(['name' => 'Administrator']);

        $perms = [
            Permission::create(['name' => 'Admin Panel']),
            Permission::create(['name' => 'Admin Fixtures']),
            Permission::create(['name' => 'Admin Contracts']),
            Permission::create(['name' => 'Admin Create Contracts']),
            Permission::create(['name' => 'Admin Approve Contracts']),
            Permission::create(['name' => 'Admin Create Clubs']),
            Permission::create(['name' => 'Admin Create Fixtures']),
            Permission::create(['name' => 'Admin Approve Fixtures']),
            Permission::create(['name' => 'Admin Create Leagues']),
        ];

        foreach ($perms as $perm) {
            $role->givePermissionTo($perm);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
