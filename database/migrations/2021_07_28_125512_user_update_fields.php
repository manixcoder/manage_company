<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserUpdateFields extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string('firstName')->nullable()->after('remember_token');
      $table->string('lastName')->nullable()->after('firstName');
      $table->longText('logo')->nullable()->after('lastName');
      $table->string('company_id')->nullable()->after('logo');
      $table->string('phone')->nullable()->after('company_id');
      $table->string('salary')->nullable()->after('phone');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('firstName')->nullable();
      $table->dropColumn('lastName')->nullable();
      $table->dropColumn('logo')->nullable();
      $table->dropColumn('company_id')->nullable();
      $table->dropColumn('phone')->nullable();
      $table->dropColumn('salary')->nullable();
    });
  }
}
