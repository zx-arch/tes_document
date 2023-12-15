<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembatalanTransaksiController;
use App\Http\Controllers\BeritaAcaraNegosiasiController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SuratPemesananController;
use App\Http\Controllers\BeritaAcaraSerahTerimaController;
use App\Http\Controllers\ProformaInvoiceController;
use App\Http\Controllers\InvoiceController;

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
Route::get('/surat_pemesanan/generate-pdf', [SuratPemesananController::class, 'generatePDF']);
Route::get('/berita_acara_negosiasi/generate-pdf', [BeritaAcaraNegosiasiController::class, 'generatePDF']);
Route::get('/berita_acara_serah_terima/generate-pdf', [BeritaAcaraSerahTerimaController::class, 'generatePDF']);
Route::get('/proforma_invoice/generate-pdf', [ProformaInvoiceController::class, 'generatePDF']);
Route::get('/invoice/generate-pdf', [InvoiceController::class, 'generatePDF']);

Route::get('/history', [HistoryController::class, 'index']);
Route::post('history/download_document_upload', [HistoryController::class, 'DownloadDocumentUpload']);