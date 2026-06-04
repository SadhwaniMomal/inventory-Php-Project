<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('chart_of_accounts', function (Blueprint $table) {
      $table->id();
      $table->string('account_code')->unique();
      $table->string('account_name');
      $table->enum('account_type', ['assets', 'liability', 'equity', 'revenue', 'expense']);

      $table->unsignedBigInteger('parent_id')->nullable();
      $table->foreign('parent_id')->references('id')->on('chart_of_accounts')->onDelete('cascade');

      $table->string('financial_date', 7)->nullable();

      $table->date('opening_account_date')->nullable();
      $table->decimal('current_balance', 15, 2)->default(0);
      $table->enum('nature_account', ['debit', 'credit'])->default('debit');

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('chart_of_accounts');
  }
};
