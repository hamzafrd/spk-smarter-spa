<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSmarter extends Model
{
  use HasFactory;

  protected $table = 'hasilsmarter';
  protected $guarded = [''];

  public function alternatif()
  {
    return $this->hasMany(Alternatif::class, 'id', 'alternatif_id');
  }
}
