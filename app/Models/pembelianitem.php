<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelianitem extends Model
{
    use HasFactory;
    protected $fillable = ['total_harga'];
    protected $table = 'pembelianitems';

    public function produk(){
        return $this->belongsToMany(pembelianitem::class);
    }
}
