<?php

use Illuminate\Database\Seeder;

class userTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
		$userData = array(
			array(
				'id' => 1,
				'name' => 'administrator',
				'firstName' => 'Super',
				'lastName' => 'Admin',
				'email' => 'admin@gmail.com',
				'email_verified_at' =>  date("Y-m-d H:i:s"),
				'password' => bcrypt('plokijuh@123'),
				'remember_token' => null,
				'logo' => null,
				'created_at' =>  date("Y-m-d H:i:s"),
				'updated_at' =>  date("Y-m-d H:i:s"),
			),
			array(
				'id' => 2,
				'name' => 'company',
				'firstName' => 'Company',
				'lastName' => 'Company',
				'email' => 'company@gmail.com',
				'email_verified_at' =>  date("Y-m-d H:i:s"),
				'password' => bcrypt('plokijuh@123'),
				'remember_token' => null,
				'logo' => null,
				'created_at' =>  date("Y-m-d H:i:s"),
				'updated_at' =>  date("Y-m-d H:i:s"),
			),
		);
		DB::table('users')->insert($userData);
	}
}
