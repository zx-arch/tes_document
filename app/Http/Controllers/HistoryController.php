<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDocumentModel;

class HistoryController extends Controller
{
    public function index()
    {
        $getdata = UserDocumentModel::getAll('user_a');
        return view('history', [
            'getdata' => $getdata
        ]);
    }
    public function DownloadDocumentUpload(Request $request)
    {
        $get = UserDocumentModel::select('file', 'nama_document')->where('username', '=', $request->username)->where('jenis_document', '=', $request->jenis_document)->get()[0];
        //dd($get);
        // Ambil data blob (misalnya dari database)
        $blobData = $get->file; // Ambil data blob sesuai dengan implementasi Anda

        // Tentukan nama file PDF (misalnya 'file.pdf')
        $filename = $get->nama_document;

        // Atur header untuk response
        $headers = [
            'Content-Type' => 'application/pdf; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        // Kembalikan response dengan data blob dan header
        return response($blobData, 200, $headers);
    }
}