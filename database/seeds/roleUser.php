<?php

use Illuminate\Database\Seeder;

class roleUser extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('role_user')->delete();
    $userRole =
      array(
        array(
          'user_id'  =>  1,
          'role_id'  =>  1,
        ),
        array(
          'user_id'  =>  2,
          'role_id'  =>  2,
        ),
      );
    DB::table('role_user')->insert($userRole);
  }
}
