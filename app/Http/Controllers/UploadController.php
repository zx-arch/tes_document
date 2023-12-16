<?php

namespace App\Http\Controllers;

use App\Models\UserDocumentModel;
use Illuminate\Database\QueryException;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('document');
        if ($file->getMimeType() == 'application/pdf') {
            if ($file->getSize() <= 512000) {

                try {
                    $fileContent = file_get_contents($file->getRealPath());

                    $username = 'user_a';
                    $skptDocuments = UserDocumentModel::getSpesificDocumentsForUser($username, $request->select_form);
                    if (sizeof($skptDocuments) == 0) {
                        // Menyimpan data ke dalam database
                        UserDocumentModel::create([
                            'username' => 'user_a',
                            'jenis_document' => $request->select_form,
                            'nama_document' => $file->getClientOriginalName(),
                            'file' => $fileContent,
                        ]);
                        return redirect('/upload')->with('add_document_success', 'Berhasil menambahkan document');
                    } else {
                        try {
                            UserDocumentModel::where('username', 'user_a')
                                ->where('jenis_document', $request->select_form)
                                ->update([
                                    'nama_document' => $file->getClientOriginalName(),
                                    'file' => file_get_contents($file->getRealPath())
                                ]);

                            return redirect('/upload')->with('update_document_success', 'Berhasil mengupdate document');

                        } catch (\Exception $e) {
                            dd($e->getMessage());
                        }
                    }
                } catch (QueryException $e) {
                    $errorInfo = $e->errorInfo;

                    // Mencetak informasi kesalahan
                    dd($errorInfo);
                }
            } else {
                return redirect('/upload')->with('add_size_invalid', 'Ukuran PDF minimal 300 KB');
            }
        } else {
            return redirect('/upload')->with('add_type_invalid', 'Jenis file tidak diijinkan');
        }
    }
}