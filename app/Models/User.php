<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable,HasFactory,HasApiTokens;
    
    protected $primaryKey = 'id_user'; // Menentukan nama kolom kunci utama

    protected $fillable = ['name', 'password','no_telp','tanggal_lahir','jenis_kelamin','alamat','email','id_lokasi'];
    protected $hidden = ['password','id_role'];
    protected $table = 'users';
    public function role(){
        return $this->hasOne(role::class);
    }

    public function lokasi() {
        return $this->belongsTo(lokasi::class, 'id_lokasi');
    }

    public function voucher(){
        return $this->hasMany(voucher::class);
    }

    public function pembelian(){
        return $this->hasOne(pembelian::class);
    }

    public function bill(){
        return $this->hasMany(bill::class);
    }

        
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Mengembalikan nilai kunci unik (biasanya ID pengguna)
    }
    public function getJWTCustomClaims()
    {
        return []; // Menambahkan klaim tambahan jika diperlukan
    }
}
