<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('garages', function (Blueprint $table) {
      $table->dropColumn('unit');
      $table->boolean('is_default')->default(false)->after('length');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('garages', function (Blueprint $table) {
      $table->string('unit')->nullable();
      $table->dropColumn('is_default');
    });
  }
};
