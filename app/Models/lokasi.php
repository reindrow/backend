<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_lokasi';
    protected $fillable = ['nama','alamat','kota','kodepos'];
    protected $table = 'lokasis';

    public function booking(){
        return $this->hasOne(booking::class);
    }
    public function users() {
        return $this->hasMany(User::class, 'id_lokasi');
    }
}
