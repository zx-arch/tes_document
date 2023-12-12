<?php

namespace App\Http\Controllers;

use App\Models\PembatalanTransaksiModel;
use Illuminate\Database\QueryException;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('document');
        if ($file->getMimeType() == 'application/pdf') {
            if ($file->getSize() <= 307200) {

                try {
                    $fileContent = file_get_contents($file->getRealPath());

                    if ($request->select_form == 'skpt') {
                        $username = 'user_a';
                        $skptDocuments = PembatalanTransaksiModel::getDocumentsForUser($username);
                        if (sizeof($skptDocuments) == 0) {
                            // Menyimpan data ke dalam database
                            PembatalanTransaksiModel::create([
                                'username' => 'user_a',
                                'nama_document' => $file->getClientOriginalName(),
                                'file' => $fileContent,
                            ]);
                            return redirect('/upload')->with('add_document_success', 'Berhasil menambahkan document');
                        } else {
                            try {
                                PembatalanTransaksiModel::where('id', $request->id)
                                    ->where('kode_document', $request->kode_document)
                                    ->update([
                                        'nama_document' => $file->getClientOriginalName(),
                                        'file' => file_get_contents($file->getRealPath())
                                    ]);

                                return redirect('/upload')->with('update_document_success', 'Berhasil mengupdate document');

                            } catch (\Exception $e) {
                                dd($e->getMessage());
                            }
                        }
                    }
                } catch (QueryException $e) {
                    $errorInfo = $e->errorInfo;

                    // Mencetak informasi kesalahan
                    dd($errorInfo);
                }
            } else {
                return redirect('/upload')->with('add_size_invalid', 'Ukuran PDF minimal 4 MB');
            }
        } else {
            return redirect('/upload')->with('add_type_invalid', 'Jenis file tidak diijinkan');
        }
    }
}