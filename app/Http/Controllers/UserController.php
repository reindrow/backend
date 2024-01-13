<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\voucher;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Mendapatkan data pelanggan
    public function getCustomers()
    {
        // Mengambil semua pelanggan dengan role 'pengguna' (role id dapat disesuaikan)
        $customers = User::where('id_role', '3')->get(['name', 'email', 'tanggal_lahir', 'no_telp', 'alamat']);
        return response()->json($customers);
    }
    public function getServers()
    {
        // Mengambil semua pelanggan dengan role 'pengguna' (role id dapat disesuaikan)
        $servers = User::where('id_role', '2')->get(['name', 'email', 'tanggal_lahir', 'no_telp', 'alamat']);
        return response()->json($servers);
    }

    
    // Fungsi untuk mengedit data pengguna berdasarkan ID
    public function updateCustomer(Request $request, $id)
    {
        // Validasi data yang dikirimkan untuk update
        $validatedData = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $id,
            'tanggal_lahir' => 'date',
            'no_telp' => 'string',
            'alamat' => 'string',
            // Sesuaikan aturan validasi dengan kebutuhan
        ]);

        try {
            // Cetak data permintaan dan data yang divalidasi
            error_log('Request data: ' . print_r($request->all(), true));
            error_log('Validated data: ' . print_r($validatedData, true));
    
            // Lakukan update data pelanggan
            User::where('id_user', $id)->update($validatedData);
    
            // Temukan pengguna berdasarkan ID dengan role 'pengguna' (role id 3)
            $customer = User::where('id_user', $id)->first();
    
            // Periksa jika pelanggan tidak ditemukan
            if (!$customer) {
                return response()->json(['message' => 'Customer not found'], 404);
            }
    
            return response()->json(['message' => 'Customer data updated successfully', 'customer' => $customer], 200);
        } catch (\Exception $e) {
            // Cetak pesan kesalahan
            error_log($e->getMessage());
            return response()->json(['message' => 'Failed to update customer data', 'error' => $e->getMessage()], 500);
        }
    }
    
}