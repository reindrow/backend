<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\pembelianitem;

class ProdukController extends Controller
{
    public function ambilProduk()
    {
        try {
            // Mendapatkan semua produk dari database
            $products = Produk::all();

            // Mengembalikan data produk sebagai response JSON
            return response()->json(['message' => 'Success', 'products' => $products], 200);
        } catch (\Exception $e) {
            // Menangani kesalahan dan mengembalikan pesan error
            return response()->json(['message' => 'Failed to fetch products', 'error' => $e->getMessage()], 500);
        }
    }
    public function tambahJenisProduk(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'jenisproduk' => 'required|string|in:barang,jasa,snack', // Menambahkan opsi default barang, jasa, snack
        ]);
    
        $produk = new Produk;
        $produk->nama = $request->input('nama');
        $produk->deskripsi = $request->input('deskripsi');
        $produk->harga = $request->input('harga');
        $produk->stok = $request->input('stok');
        $produk->jenisproduk = $request->input('jenisproduk');
        $produk->save();
    
        return response()->json(['message' => 'Jenis produk ' . $produk->jenisproduk . ' ditambahkan', 'produk' => $produk], 201);
    }
    public function updateProduk(Request $request, $id)
{
    $request->validate([
        'nama' => 'string',
        'deskripsi' => 'string',
        'harga' => 'numeric',
        'stok' => 'integer',
        'jenisproduk' => 'string|in:barang,jasa,snack',
    ]);

    try {
        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama' => $request->input('nama', $produk->nama),
            'deskripsi' => $request->input('deskripsi', $produk->deskripsi),
            'harga' => $request->input('harga', $produk->harga),
            'stok' => $request->input('stok', $produk->stok),
            'jenisproduk' => $request->input('jenisproduk', $produk->jenisproduk),
        ]);

        return response()->json(['message' => 'Produk berhasil diupdate', 'produk' => $produk], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Gagal mengupdate produk', 'error' => $e->getMessage()], 500);
    }
}
public function hapusProduk($id)
{
    try {
        // Periksa apakah ada pembelianitem terkait
        $jumlahPembelianItem = PembelianItem::where('id_produk', $id)->count();

        if ($jumlahPembelianItem > 0) {
            return response()->json(['message' => 'Gagal menghapus produk. Produk memiliki pembelianitem terkait.'], 400);
        }

        $produk = Produk::findOrFail($id);
        $produk->delete();

        return response()->json(['message' => 'Produk berhasil dihapus'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Gagal menghapus produk', 'error' => $e->getMessage()], 500);
    }
}


}
