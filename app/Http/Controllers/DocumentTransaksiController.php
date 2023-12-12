<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentTransaksiModel;

class DocumentTransaksiController extends Controller {
    public function skpt_barang_diterima(Request $request) {
        $kode_doc = session('kode_document');
        DocumentTransaksiModel::create([
            'username' => 'user_a',
            'jenis_surat' => $kode_doc,
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'jumlah' => $request->jumlah,
        ]);
        return redirect('/pembatalan_transaksi')->with('add_barangditerima_success', 'Berhasil menambahkan barang');
    }
}