<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_booking','status'];
    protected $table = 'bookings';

    public function bill(){
        return $this->hasOne(bill::class);
    }
}
