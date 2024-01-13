<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LokasiController extends Controller
{
    // Menampilkan semua lokasi
    public function index()
    {
        $lokasis = Lokasi::all();
        return response()->json($lokasis);
    }

    // Menambahkan lokasi baru
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan untuk menyimpan lokasi
        $validatedData = $request->validate([
            'nama' => 'required|string|unique:lokasis',
            'alamat' => 'required',
            'kota' => 'required',
            'kodepos' =>'required'
            // Sesuaikan aturan validasi dengan kebutuhan
        ]);

        // Menyimpan lokasi baru
        $lokasi = Lokasi::create($validatedData);

        return response()->json(['message' => 'Lokasi added successfully', 'lokasi' => $lokasi], 201);
    }

    // Menghapus lokasi
    public function destroy($id)
    {
        // Temukan lokasi berdasarkan ID
        $lokasi = Lokasi::find($id);

        // Periksa jika lokasi tidak ditemukan
        if (!$lokasi) {
            return response()->json(['message' => 'Lokasi not found'], 404);
        }

        // Hapus lokasi
        $lokasi->delete();

        return response()->json(['message' => 'Lokasi deleted successfully'], 200);
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan untuk update
        $validatedData = $request->validate([
            'nama' => 'string|unique:lokasis,nama,' . $id,
            'alamat' => 'string',
            'kota' => 'string',
            'kodepos' => 'string'
            // Sesuaikan aturan validasi dengan kebutuhan
        ]);

        try {
            // Temukan lokasi berdasarkan ID
            $lokasi = Lokasi::find($id);

            // Periksa jika lokasi tidak ditemukan
            if (!$lokasi) {
                return response()->json(['message' => 'Lokasi not found'], 404);
            }

            // Lakukan update data lokasi
            $lokasi->update($validatedData);

            return response()->json(['message' => 'Lokasi updated successfully', 'lokasi' => $lokasi], 200);
        } catch (\Exception $e) {
            // Cetak pesan kesalahan
            error_log($e->getMessage());
            return response()->json(['message' => 'Failed to update lokasi', 'error' => $e->getMessage()], 500);
        }
    }
}
