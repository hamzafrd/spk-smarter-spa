<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smarter extends Model
{
    use HasFactory;

    protected $table = 'smarter';
    protected $fillable = ['hasil_utility', 'total', 'rank'];

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class);
    }
    public function subkriteria()
    {
        return $this->hasManyThrough(SubKriteria::class, Kriteria::class);
    }
}
