<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('coa_contacts', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('coa_id');
      $table->foreign('coa_id')->references('id')->on('chart_of_accounts')->onDelete('cascade');

      $table->string('account_code')->unique();
      $table->string('name');
      $table->string('company_name')->nullable();
      $table->string('cnic')->nullable();
      $table->string('phone_number');

      $table->unsignedBigInteger('city_id');
      $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

      $table->string('address');
      $table->decimal('opening_balance', 15, 2)->default(0);
      $table->date('opening_account_date')->nullable();
      $table->decimal('current_balance', 15, 2)->default(0);
      $table->enum('nature_account', ['debit', 'credit'])->default('debit');

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('coa_contacts');
  }
};
