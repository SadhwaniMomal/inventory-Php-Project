<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherAccount extends Model
{
  protected $table = 'other_accounts';

  protected $fillable = [
    'coa_id',
    'sub_coa_id',
    'name',
    'account_code',
    'opening_account_date',
    'nature_account',
    'opening_balance',
  ];

  public function account()
  {
    return $this->belongsTo(ChartOfAccount::class, 'coa_id');
  }

  public function subAccount()
  {
    return $this->belongsTo(ChartOfAccount::class, 'sub_coa_id');
  }
}
