<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_booking';
    protected $fillable = ['id_user', 'id_lokasi', 'id_voucher','tanggal_booking','status'];
    protected $table = 'bookings';

    public function bill(){
        return $this->hasOne(bill::class);
    }
}
