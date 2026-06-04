<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
  protected $table = 'garages';

  protected $fillable = [
    'length',
    'label',
    'is_default',
  ];
}
