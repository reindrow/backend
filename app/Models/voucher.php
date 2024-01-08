<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    use HasFactory;
    protected $fillable = ['kode_voucher','tanggal_kadaluarsa','diskon'];
    protected $table = 'vouchers';

    public function bill(){
        return $this->hasOne(bill::class);
    }
}
