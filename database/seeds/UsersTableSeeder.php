<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
			'name' => 'pierre',
			'email' => 'pierre.aubrion54150@gmail.com',
			'password' => bcrypt('Kasteel54'),
			'role'	=> '1'
		]);
		DB::table('users')->insert([
			'name' => 'jean-pierre',
			'email' => 'blaise.jean-pierre@wanadoo.fr',
			'password' => bcrypt('piennes54'),
			'role'	=> '2'
		]);
    }
}
