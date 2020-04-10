<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@site.test',
            'role' => User::AdminRole
        ]);

        factory(User::class)->create([
            'email' => 'super@site.test',
            'role' => User::SuperRole
        ]);

        factory(User::class)->create([
            'email' => 'user@site.test',
            'role' => User::NormalUser
        ]);
    }
}
