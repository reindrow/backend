<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class ServerController extends Controller
{
    public function addServer(Request $request)
    {
        // Validasi data yang dikirimkan untuk menambahkan user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'no_telp' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        try {
            // Membuat user baru dan menyimpannya ke dalam database
            $user = new User([
                'name' => $validatedData['name'],
                'password' => bcrypt($validatedData['password']),
                'no_telp' => $validatedData['no_telp'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'alamat' => $validatedData['alamat'],
                'email' => $validatedData['email'],
            ]);

            // Set id_role menjadi 2
            $user->id_role = 2;

            // Simpan user ke dalam database
            $user->save();

            return response()->json(['message' => 'User berhasil ditambahkan', 'data' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menambahkan user', 'error' => $e->getMessage()], 500);
        }
    }
}
