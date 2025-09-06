<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;

use App\Models\User;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Str::random();
        $user = User::factory()->create([
            'username' => 'administrator',
            'name' => 'Administrador',
            'email' => 'administrator@mineco.gob.gt',
            'password' => $password
        ]);
        $this->command->info('Usuario administrador creado');
        $this->command->info('username:' . $user->username);
        $this->command->info('password:' . $password);

        $role = Role::find(1);
        $user->assignRole($role);
        $this->command->info('Rol de administrador asignado');
    }
}
