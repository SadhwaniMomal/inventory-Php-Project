<?php

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
    Schema::create('inventories', function (Blueprint $table) {
      $table->id();
      $table->string('account_code');
      $table->foreignId('coa_id')->constrained('chart_of_accounts');
      $table->string('product_name')->nullable();
      $table->foreignId('size_id')->constrained('sizes');
      $table->foreignId('garage_id')->constrained('garages');
      $table->string('quality')->nullable();
      $table->decimal('opening_quantity', 10, 2)->default(0);
      $table->decimal('opening_amount', 15, 2)->default(0);
      $table->date('opening_date')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('inventories');
  }
};
