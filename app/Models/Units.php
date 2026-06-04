<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
  protected $table = 'units'; // Explicitly names the DB table

  // $fillable lists columns that are mass-assignable (safe from mass assignment attacks)
  protected $fillable = [
    'name',
    'size',
    'conversion',
  ];
}
