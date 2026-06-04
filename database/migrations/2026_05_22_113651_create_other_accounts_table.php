<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('other_accounts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('coa_id')->constrained('chart_of_accounts')->onDelete('cascade');
      $table->foreignId('sub_coa_id')->nullable()->constrained('chart_of_accounts')->onDelete('set null');
      $table->string('account_code')->unique(); // added
      $table->string('name');
      $table->date('opening_account_date')->nullable();
      $table->enum('nature_account', ['debit', 'credit']);
      $table->decimal('opening_balance', 15, 2)->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('other_accounts');
  }
};
