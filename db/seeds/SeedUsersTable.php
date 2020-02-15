<?php

use App\Models\User;
use Cradle\Seed;

class SeedUsersTable extends Seed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $user = new User;
        $user->username = $this->faker->username;
        $user->password = password_hash('password', PASSWORD_DEFAULT);
        $user->auth_token = password_hash(bin2hex(random_bytes(100)), PASSWORD_DEFAULT);
        $user->save();
    }
}
