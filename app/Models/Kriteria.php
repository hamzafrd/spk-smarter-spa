<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    // protected $guarded = ['id'];
    protected $fillable = ['nama', 'rank', 'bobot'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subkriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function smarter()
    {
        return $this->hasMany(Smarter::class);
    }
}
