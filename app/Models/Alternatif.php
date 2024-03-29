<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';
    protected $fillable = ['nama'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function smarter()
    {
        return $this->hasMany(Smarter::class);
    }
}
