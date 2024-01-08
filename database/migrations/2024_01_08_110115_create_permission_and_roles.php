<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Créer les roles pour l'application
     */
    public function up(): void
    {
        $joueur = Role::create(['name' => 'joueur']);
        $mj = Role::create(['name' => 'mj']);
        $modo = Role::create(['name' => 'modo']);
        $admin = Role::create(['name' => 'admin']);


        $ajout_tables = Permission::create(['name' => 'ajout_tables']);
        $manage_tables_own = Permission::create(['name' => 'manage_tables_own']);
        $manage_tables_all = Permission::create(['name' => 'manage_tables_all']);

        $ajout_events = Permission::create(['name' => 'ajout_events']);
        $manage_roles = Permission::create(['name' => 'manage_roles']);
        $manage_descriptions = Permission::create(['name' => 'manage_descriptions']);

        $ajout_tags = Permission::create(['name' => 'ajout_tags']);
        $ajout_tws = Permission::create(['name' => 'ajout_tws']);
        $permissions_mj = [$ajout_tables,$manage_tables_own,$ajout_tags,$ajout_tws];
        $permissions_modo = [$manage_tables_all,$ajout_events,$ajout_tags,$ajout_tws];

        $permissions_admin = [$manage_roles,$manage_descriptions];

        $mj->syncPermissions($permissions_mj);
        $modo->syncPermissions($permissions_modo);

        $admin->syncPermissions(array_merge($permissions_modo,$permissions_admin));



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
