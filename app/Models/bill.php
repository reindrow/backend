<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    use HasFactory;
    protected $fillable = ['ref_id','ref_type','status_pembayaran','metode_pembayaran'];
    protected $table = 'bills';

    public function pembelianitem(){
        return $this->hasMany(pembelianitem::class);
    }
}
