<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    use HasFactory;
    protected $fillable = ['nama','alamat','kota','kodepos'];
    protected $table = 'lokasis';

    public function booking(){
        return $this->hasOne(booking::class);
    }
}
