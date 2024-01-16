<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produk';

    protected $fillable = ['nama_produk', 'deskripsi', 'harga','stok','jenisproduk'];
    protected $table = 'produks';
}
