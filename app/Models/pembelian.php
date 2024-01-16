<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pembelian';
    protected $fillable = ['id_user','id_server','tanggal_pembelian'];
    protected $table = 'pembelians';

    public function pembelianitem(){
        return $this->hasMany(pembelianitem::class);
    }

    public function bill(){
        return $this->hasMany(bill::class);
    }
}
