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
            'email' => 'admin@site.test'
        ]);

        factory(User::class)->create([
            'email' => 'user@site.test'
        ]);
    }
}
