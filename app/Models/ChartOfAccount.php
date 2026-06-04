<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
  protected $fillable = [
    'account_code',
    'account_name',
    'account_type',
    'parent_id',
    'financial_date',
    'opening_account_date',
    'current_balance',
    'nature_account',
  ];
  // Is account ka parent kaun hai
  public function parent()
  {
    return $this->belongsTo(ChartOfAccount::class, 'parent_id');
  }

  // Is account ke tamam bachay
  public function children()
  {
    return $this->hasMany(ChartOfAccount::class, 'parent_id');
  }

  public static function generateAccountCode($parentId = null, $accountType = 'assets')
  {
    $accountPrefixes = [
      'assets'    => '01',
      'liability' => '02',
      'equity'    => '03',
      'revenue'   => '04',
      'expense'   => '05',
    ];
    if ($parentId == null) {
      return $accountPrefixes[$accountType];
    }
    $parentAccount = ChartOfAccount::find($parentId);
    $childrenCount = ChartOfAccount::where('parent_id', $parentId)->count();
    $nextNumber = $childrenCount + 1;
    $formattedNumber = str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
    $newAccountCode = $parentAccount->account_code . '-' . $formattedNumber;
    return $newAccountCode;
  }
}
