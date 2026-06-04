<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockinventory extends Model
{
  protected $table = 'inventories';

  protected $fillable = [
    'account_code',
    'product_id',
    'product_name',
    'size_id',
    'garage_id',
    'opening_quantity',
    'opening_amount',
    'opening_date',
  ];

  // ── Product - chart_of_accounts table se ──
  public function product()
  {
    return $this->belongsTo(ChartOfAccount::class, 'product_id');
  }

  // ── Size ──
  public function size()
  {
    return $this->belongsTo(Size::class, 'size_id');
  }

  // ── Garage ──
  public function garage()
  {
    return $this->belongsTo(Garage::class, 'garage_id');
  }
}
