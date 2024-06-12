<?php

use App\Enums\Role as RoleEnum;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // dd(
        //     Role::where('name', RoleEnum::WRITTER->value)->first()->id
        // );

        $users = [
            [
                'name' => 'Lucas Oliveira',
                'email' => 'lucas@jellycode.com.br',
                'password' => bcrypt('123456'),
                'role_id' => Role::where('name', RoleEnum::WRITTER->value)->first()->id
            ],
            [
                'name' => 'Filipe Santana',
                'email' => 'filipe@jellycode.com.br',
                'password' => bcrypt('123456'),
                'role_id' => Role::where('name', RoleEnum::VIEWER->value)->first()->id
            ]
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
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
