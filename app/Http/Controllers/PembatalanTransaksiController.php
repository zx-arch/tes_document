<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDocumentModel;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Cache;

class PembatalanTransaksiController extends Controller
{
    public function sorting(Request $request)
    {
        if ($request->sorting == 'document_terbaru') {
            $getdata = UserDocumentModel::select('kode_document', 'username', 'nama_document', 'created_at')->where('deleted_at', '=', null)->orderBy('created_at', 'desc')->take(75)->get();
        } else {
            $getdata = UserDocumentModel::select('kode_document', 'username', 'nama_document', 'created_at')->where('deleted_at', '=', null)->orderBy('created_at', 'asc')->take(75)->get();
        }
        return $getdata;
    }

    private function textSurat($pdf)
    {
        $pdf->SetFont('times', 'B', 14);

        $txt = 'Surat Kesepakatan Pembatalan Transaksi';
        $pdf->MultiCell(0, 17, $txt, 0, 'C', false);

        $pdf->SetFont('times', '', 12);
        $textColor = array(0, 0, 0); // RGB untuk biru tua

        // Warna border
        $borderColor = array(0, 0, 0); // RGB untuk hitam

        // Tambahkan field dengan warna teks dan border yang diinginkan
        $pdf->SetFillColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetDrawColor($textColor[0], $textColor[1], $textColor[2]);


        $pdf->Cell(25, 8, 'Pada hari ini ');
        $pdf->TextField('field_hari', 25, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));
        $pdf->Cell(20, 8, ' tanggal');
        $pdf->TextField('field_tgl', 45, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => 'format: 2023-01-01'));
        $pdf->SetFillColor(255, 255, 200);

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit
        $pdf->Cell(25, 8, 'bertempat di ');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->TextField('field_tmpt', 80, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Cell(70, 8, ' yang bertanda tangan di bawah ini: ');
        $pdf->Ln(15); // Baris baru dengan jarak 10 unit

        $pdf->Cell(40, 8, 'Nama                      : ');
        $pdf->TextField('field_nm_satdik', 60, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(40, 8, 'Tugas / Jabatan       : ');
        $pdf->TextField('field_tgs_satdik', 60, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(40, 8, 'NIP                          : ');
        $pdf->TextField('field_nip_satdik', 60, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(40, 8, 'Satuan Pendidikan  : ');
        $pdf->TextField('field_satdik', 60, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(40, 8, 'Alamat                    :');
        $pdf->TextField('field_almt1', 140, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit
        $pdf->Cell(40, 8, '');
        $pdf->TextField('field_almt2', 140, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(15);
        $pdf->SetFont('times', 'B', 12);
        $txt = 'Selanjutnya disebut sebagai "Satuan Pendidikan"';
        $pdf->MultiCell(0, 12, $txt, 0, 'L', false);

        $pdf->SetFont('times', 12);

        $pdf->Cell(70, 8, 'Nama Penyedia                                : ');
        $pdf->TextField('field_nm_penyedia', 60, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(70, 8, 'Nama Badan Hukum (Jika Ada)      : ');
        $pdf->TextField('field_bdn_hukum', 60, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(70, 8, 'Jabatan                                             : ');
        $pdf->TextField('field_jabatan', 60, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(70, 8, 'Alamat                                             :');
        $pdf->TextField('field_almt_penyedia', 100, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));

        $pdf->Ln(15); // Baris baru dengan jarak 10 unit
        $pdf->SetFont('times', 'B', 12);
        $txt = 'Selanjutnya disebut sebagai "Penyedia"';
        $pdf->MultiCell(0, 10, $txt, 0, 'L', false);

        $pdf->SetFont('times', 12);
        $txt = 'Bersama dengan ini, Satuan Pendidikan dan Penyedia menyatakan dan menyepakati hal-hal sebagai berikut:';
        $pdf->MultiCell(0, 12, $txt, 0, 'J');

        $txt = '1. Para pihak telah melakukan kerjasama pengadaan barang dengan Nomor Pesanan';
        $pdf->MultiCell(0, 8, $txt, 0, 'J');
        $pdf->TextField('field_nmr_psn', 60, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));
        $pdf->Cell(45, 8, 'yang dibuat pada tanggal ');
        $pdf->TextField('field_tgl_psn', 45, 8, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '....................'));
        $pdf->Cell(50, 8, '  dengan  rincian');
        $pdf->Ln(8);
        $pdf->Cell(0, 8, 'seluruh pesanan: (harap isi dengan rincian dalam surat pesanan)');

        $this->addTable($pdf);
        $pdf->SetLineStyle(0.21); // Set line spacing for the first line to 0.21 mm

        $pdf->Cell(50, 6, '2. Bahwa Satuan Pendidikan');
        $pdf->ComboBox('menerima_barang1', 16, 6, array(array('blm', 'belum'), array('t', 'telah')));
        $pdf->Cell(60, 6, 'menerima barang tersebut dalam keadaan utuh dan baik.');

        $pdf->Ln(12);
        $txt = '<span style="text-align: justify; line-height: 1.5">3. Bahwa penyedia telah memberikan masa dan waktu pelunasan pembayaran pesanan dengan membayar ke rekening Mitra dengan nomor rekening</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();

        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 73; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML + 6;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);

        // Tambahkan textfield di samping teks HTML
        $pdf->TextField('field_nmr_rek', 65, 6, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '...............................'));

        $pdf->Ln(12);
        $txt = '<span style="text-align: justify;">4. Bahwa Satuan Pendidikan</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();

        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 50; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);

        // Tambahkan textfield di samping teks HTML
        $pdf->ComboBox('menerima_barang2', 15, 6, array(array('', 'belum'), array('telah', 'telah')));
        $txt = '<span style="text-align:justify;line-height: 1.5;">melakukan pembayaran ke rekening Mitra ataupun ke pihak lain melalui cara berbeda. Pembayaran belum dilakukan Sekolah atas: .</span>';
        $pdf->writeHTML($txt, true, false, false, false, 'J');

        $pdf->Ln(2);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('seluruh_pesanan', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'seluruh pesanan; atau');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('sebagian_pesanan', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'sebagian pesanan, dengan rincian barang yang belum dibayarkan (Nama
Barang & Qty):');

        $pdf->Ln(8);
        $pdf->Cell(26, 5, '');
        $pdf->TextField('field_rnc1', 120, 6, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '..................................'));

        $pdf->Ln(9);
        $pdf->Cell(26, 5, '');
        $pdf->TextField('field_rnc2', 120, 6, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '..................................'));

        $pdf->Ln(12);
        $pdf->Cell(55, 6, '5. Bahwa Satuan Pendidikan tidak melakukan pembayaran akibat: (tandai alasan yang benar)');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('sulit_dihubungi', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Penyedia Sulit di hubungi');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('permintaan_penyedia', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Permintaan penyedia');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('pesanan_baru', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Ingin merubah rincian dan membuat pesanan baru');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('waktu_kirim_lama', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Penyedia membutuhkan waktu lama untuk mengirim');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('waktu_kirim_lama', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Penyedia menyalahi aturan perjanjian / aturan kerja sama');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('lewat_tahun_anggaran', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Pesanan sudah melewati tahun anggaran');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('sumber_dana_satdik_tdk_sesuai', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Sumber dana yang digunakan Satdik tidak sesuai');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('dobel_order', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Pesanan berganda (double order)');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('dua_pihak_sepakat_batal_transaksi', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Satdik dan Penyedia sepakat untuk membatalkan transaksi');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('pembayaran_manual', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Pesanan telah diselesaikan secara manual / Pembayaran manual');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('salah_perhitungan_transaksi', 5, false, array(), array(), 'OK');
        $pdf->Cell(10, 5, 'Kesalahan Pehitungan nilai transaksi baik harga maupun pajak');

        $pdf->Ln(8);
        $pdf->Cell(20, 5, '');
        $pdf->CheckBox('lainnya', 5, false, array(), array(), 'OK');
        $pdf->Cell(18, 5, 'Lainnya');
        $pdf->TextField('field_lainnya', 80, 6, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '..................................'));

        $pdf->Ln(12);
        $txt = '<span style="text-align: justify; line-height: 1.5;"><b>6. Atas pesanan yang tidak dilakukan pembayaran, maka kedua belah pihak sepakat untuk</b></span><span style="text-align: justify; line-height: 1.5;"><b>melakukan pembatalan pesanan.</b> Dalam hal pesanan sudah diterima oleh Satuan Pendidikan, maka</span><span style="line-height: 1.5;">Satuan Pendidikan melakukan pengembalian</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();

        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 87; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML + 13;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);

        // Tambahkan textfield di samping teks HTML
        $pdf->ComboBox('pengembalian_barang1', 20, 6, array(array('', 'seluruh'), array('sebagian', 'sebagian')));
        $txt = '<span style="text-align:justify;line-height: 1.5;">barang yang dipesan dalam keadaan utuh dan jumlah yang sesuai kepada Penyedia.</span>';
        $pdf->writeHTML($txt, true, false, false, false, 'J');

        $pdf->Ln(8);
        $txt = '<span style="text-align:justify;line-height: 1.5;"><b>7. Atas pesanan yang tidak dilakukan pembayaran, maka kedua belah pihak sepakat untuk</b> melakukan pembatalan pesanan. Dalam hal pesanan sudah diterima oleh Satuan Pendidikan, maka Satuan Pendidikan melakukan pengembalian</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();

        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 65; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML + 13;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);

        // Tambahkan textfield di samping teks HTML
        $pdf->ComboBox('pengembalian_barang2', 20, 6, array(array('', 'seluruh'), array('sebagian', 'sebagian')));
        $txt = '<span style="text-align:justify;line-height: 1.5;">barang yang dipesan dalam keadaan utuh dan jumlah yang sesuai kepada Penyedia dan pengembalian pembayaran sesuai ketentuan yang berlaku.</span>';
        $pdf->writeHTML($txt, true, false, false, false, 'J');

        $pdf->SetMargins(15, 25, 15, 20); // Set left, top, and right margins to 15 mm
        // Tambahkan halaman baru
        $pdf->AddPage();
        $txt = '<span style="text-align:justify;line-height: 1.5;">8. Bahwa Penyedia telah menerima pengembalian barang tersebut dibuktikan dengan faktor retur penjualan. Dalam hal terdapat sebagian pesanan yang tidak dikembalikan, Satuan Pendidikan telah melakukan pembayaran atas sebagian pesanan tersebut sesuai bukti pembayaran terelampir.</span>';
        $pdf->writeHTML($txt, true, false, false, false, 'J');

        $pdf->Ln(8);
        $txt = '<span style="text-align:justify;">Atas pembatalan</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();

        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 30; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);

        // Tambahkan textfield di samping teks HTML
        $pdf->ComboBox('pengembalian_barang3', 20, 6, array(array('', 'seluruh'), array('sebagian', 'sebagian')));
        $txt = '<span style="text-align:justify;line-height: 1.5;"> pesanan tersebut, Satuan Pendidikan dan Penyedia tidak terlibat lagi dalam perjanjian pengadaan Nomor Pesanan</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();

        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 65; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML + 6;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);
        $pdf->TextField('field_nmr_psn', 60, 6, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '..................................'));
        $pdf->Ln(8);
        $txt = 'Tanggal';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();
        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 15; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);
        $pdf->TextField('field_tgl', 45, 6, array('multiline' => true, 'lineWidth' => 0, 'borderStyle' => 'none', 'textSize' => 0, 'value' => '..................................'));
        $pdf->Cell(10, 5, 'yang telah dibuat sebelumnya');

        $pdf->Ln(15);
        $txt = '<span style="text-align:justify;line-height: 1.5;">Demikian Surat Pernyataan ini dibuat dalam keadaan sadar dimana kedua belah pihak menyetujui perihal pembatalan transaksi ini.</span>';
        $pdf->writeHTML($txt, true, false, false, false, 'J');

        $pdf->Ln(20);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(28, 5, '');
        $pdf->Cell(28, 5, 'Satuan Pendidikan');
        $pdf->Cell(67, 6, '');
        $pdf->Cell(30, 5, 'Penyedia');
        $pdf->SetFont('times', 12);

        $pdf->Ln(14);
        $pdf->Cell(38, 5);
        $pdf->Cell(38, 5, 'Materai');
        $pdf->Ln(14);
        $pdf->Cell(15, 5, '');
        $pdf->TextField('field_nm_satdik', 60, 6, array('value' => '                 (Nama Satdik)                '), array());

        $pdf->Ln(15);
        $pdf->Cell(43, 5);
        $pdf->Cell(43, 5, 'ttd');
        $pdf->Cell(43, 5);
        $pdf->Cell(43, 5, 'ttd');

        $pdf->Ln(10);
        $pdf->Cell(15, 5, '');
        $pdf->TextField('field_nm_penanggungjwb_satdik', 60, 6, array('value' => '  Nama Penanggungjawab Satdik  '), array());
        $pdf->Cell(25, 6, '');
        $pdf->TextField('field_nm_penanggungjwb_penyedia', 62, 6, array('value' => ' Nama Penanggungjawab Penyedia '), array());
        $pdf->Ln(8);
        $pdf->Cell(30, 5, '');
        $pdf->TextField('field_jbtn_penanggungjwb_satdik', 30, 6, array('value' => '       Jabatan    '), array());
        $pdf->Cell(55, 6, '');
        $pdf->TextField('field_jbtn_penanggungjwb_penyeida', 30, 6, array('value' => '       Jabatan    '), array());
    }

    private function addTable($pdf)
    {
        $pdf->Ln(12);
        $pdf->SetFont('times', 12);
        $header = array('No', 'Nama Barang / Jasa', 'Qty', 'Satuan', 'Harga Satuan (Rp)', 'Jumlah (Rp)');
        $columnWidths = array(10, 60, 10, 20, 40, 40);

        // Set background color for header
        $pdf->SetDrawColor(0, 0, 0); // Warna border hitam
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);

        // Add table headers
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($columnWidths[$i], 8, $header[$i], 1, 0, 'C', 1);
        }

        $pdf->Ln();

        // Table data with TextField
        $sample_data = array(
            array('1', 'Barang A', '5', 'Pcs', '100000', '500000'),
            array('2', 'Barang B', '3', 'Kg', '150000', '450000'),
            array('4', 'Barang C', '3', 'Kg', '150000', '450000'),
            array('5', 'Barang D', '3', 'Kg', '150000', '450000'),
            // ... tambahkan data sesuai kebutuhan
        );

        // Set font for data

        foreach ($sample_data as $row) {
            for ($i = 0; $i < count($row); $i++) {
                $uniqueId = uniqid();
                $fieldName = 'field_lst' . $uniqueId . '_' . $i;
                $pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'solid' => 255, 'color' => array(255, 255, 255)));

                $pdf->SetDrawColor(0, 0, 0); // Warna border hitam
                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell($columnWidths[$i], 8, '', 1); // Placeholder untuk body tabel
                $pdf->SetXY($pdf->GetX() - $columnWidths[$i], $pdf->GetY());
                //$pdf->Cell($columnWidths[$i], 8, $header[$i], 1, 0, 'C', 1);
                $pdf->TextField($fieldName, $columnWidths[$i], 8);
            }
            $pdf->Ln();
        }
        $pdf->Ln(5);
    }

    public function generatePdf()
    {
        $outputPdfPath = storage_path('app/results/berita_acara_serah_terima.pdf');

        $cacheKey = 'pdf_cache_' . uniqid();
        try {
            // Mengecek apakah PDF sudah ada di cache
            if (Cache::has($cacheKey)) {
                $pdfOutput = Cache::get($cacheKey);
                return response($pdfOutput, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="surat_kesepakatan_pembatalan_transaksi.pdf"'
                ]);
            }
            // Path untuk menyimpan hasil PDF yang dihasilkan
            $outputPdfPath = storage_path('app/results/surat_kesepakatan_pembatalan_transaksi.pdf');
            // $cacheKey = 'pdf_cache_' . uniqid();


            // Inisialisasi objek TCPDF dari FPDI
            $pdf = new Fpdi(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetTitle('Surat Keterangan Pembatalan Transaksi');  // Judul dokumen

            $pdf->Cell(0, 10, 'Surat Keterangan Pembatalan Transaksi', 0, false, 'C', 0, '', 0, false, 'M', 'M');


            // remove default header/footer
            $pdf->setPrintHeader(false);
            // $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(15, 15, 15); // Set left, top, and right margins to 15 mm

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                require_once(dirname(__FILE__) . '/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $pdf->SetFont('times', 'B', 14);

            // add a page
            $pdf->AddPage();

            $this->textSurat($pdf);

            // Simpan hasil PDF
            $pdfOutput = $pdf->Output('', 'S');
            Cache::put($cacheKey, $pdfOutput, now()->addHours(9999));

            return response(Cache::get($cacheKey), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="surat_kesepakatan_pembatalan_transaksi.pdf"'
            ]);

        } catch (\Exception $e) {
            // Tangani kesalahan caching
            // Contoh: Log kesalahan atau kembalikan respons dengan pesan kesalahan
            return response("Gagal menyimpan ke cache: " . $e->getMessage(), 500);
        }
    }
}