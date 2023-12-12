<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentTransaksiModel extends Model {
    use SoftDeletes;
    protected $table = 'transaksi_barang_diterima';
    protected $fillable = [
        'id',
        'username',
        'jenis_surat',
        'nama_barang',
        'qty',
        'satuan',
        'harga_satuan',
        'jumlah'
    ];
    protected $hidden = [];
}