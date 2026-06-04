<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoaContact extends Model
{
  protected $table = 'coa_contacts';

  protected $fillable = [
    'coa_id',
    'account_code',
    'name',
    'company_name',
    'cnic',
    'phone_number',
    'city_id',
    'address',
    'opening_balance',
    'opening_account_date',
    'current_balance',
    'nature_account',
  ];

  public function chartOfAccount()
  {
    return $this->belongsTo(ChartOfAccount::class, 'coa_id');
  }

  public function city()
  {
    return $this->belongsTo(Cities::class);
  }
}
