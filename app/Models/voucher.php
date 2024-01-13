<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $primaryKey = 'id_voucher';
    protected $fillable = ['kode_voucher','description','diskon','minimal_pembayaran','tanggal_mulai_berlaku','tanggal_berakhir_berlaku','is_new_user_only','id_user'];
    protected $table = 'vouchers';

    public function bill(){
        return $this->hasOne(bill::class);
    }
}
