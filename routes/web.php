<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembatalanTransaksiController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\DocumentTransaksiController;
use App\Http\Controllers\UploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('documents.home');
});
Route::get('/upload', function () {
    return view('upload');
});
Route::post('/upload/document', [UploadController::class, 'upload']);
Route::get('/pembatalan_transaksi/generate-pdf', [PembatalanTransaksiController::class, 'generatePDF']);

Route::get('/pembatalan_transaksi', [PembatalanTransaksiController::class, 'index']);
Route::post('/pembatalan_transaksi', [PembatalanTransaksiController::class, 'index']);
Route::post('/pembatalan_transaksi/download', [PembatalanTransaksiController::class, 'download']);
Route::post('/pembatalan_transaksi/upload/surat_pembatalan_transaksi', [PembatalanTransaksiController::class, 'upload'])->name('pembatalan_transaksi.upload');
Route::post('pembatalan_transaksi/download_document_upload', [PembatalanTransaksiController::class, 'DownloadDocumentUpload']);
Route::get('pembatalan_transaksi/delete/{user}/{kode_document}', [PembatalanTransaksiController::class, 'deleteTemporary']);
Route::post('pembatalan_transaksi/sorting', [PembatalanTransaksiController::class, 'index']);
Route::post('pembatalan_transaksi/update/{id}/{kode_document}', [PembatalanTransaksiController::class, 'update']);
Route::post('pembatalan_transaksi/transaksi/skpt/barang_diterima', [DocumentTransaksiController::class, 'skpt_barang_diterima']);

Route::get('trash', [TrashController::class, 'index']);
Route::get('trash/delete/{user}/{kode_document}', [TrashController::class, 'deletePermanent']);
Route::post('trash/restore', [TrashController::class, 'restore']);