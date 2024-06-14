<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'User with all permissions'],
            ['name' => 'writter', 'description' => 'User who can publish and edit posts'],
            ['name' => 'viewer', 'description' => 'User can only view posts'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
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
