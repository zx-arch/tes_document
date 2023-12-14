<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Tcpdf\Fpdi;
use App\Http\Controllers\PdfController;

class SuratPemesananController extends Controller
{
    public function __construct()
    {
        $this->general_pdf = new PdfController();
    }
    private function textSurat($pdf)
    {
        $this->general_pdf->createBingkai($pdf);

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY(7.5, 15);
        $pdf->Cell(10, 8, '');
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(70, 8, 'Surat Pesanan', 1, 0, 'C');
        $pdf->SetFont('times', '', 12);
        $textFieldX = $pdf->GetX() + 47;

        // Add text to the cell "Nama Satuan Pendidikan"
        $pdf->Cell(105, 8, 'Nama Satuan Pendidikan: ', 1, 0, 'L');

        // Set the X position to the saved position and add the text field
        $pdf->SetX($textFieldX);
        $pdf->TextField('field_nm_satdik', 58, 8, array('value' => '....................'), array());
        $pdf->Ln(8);

        $pdf->Cell(2.5, 5, '');
        $pdf->Cell(70, 24, '', 1, 0, 'L');

        $pdf->Cell(1.5, 8, '');
        $pdf->SetXY(17.5, 23.5);
        $pdf->Cell(70, 8, 'Paket Pesanan : ', 0, 0, 'L');
        $pdf->Ln(8);

        $pdf->SetXY(17.5, 31.5);
        $pdf->TextField('field_paket', 70, 15, array('value' => '......................', 'multiline' => true, 'maxlen' => 30), array());

        $textFieldX = $pdf->GetX() + 37;
        $pdf->SetXY(87.5, 23);

        // Add text to the cell "No Surat Pesan"
        $pdf->Cell(105, 8, 'No Surat Pesan       : ', 1, 0, 'L');

        // Set the X position to the saved position and add the text field
        $pdf->SetX($textFieldX);
        $pdf->TextField('field_nmr_surat', 68, 8, array('value' => '....................'), array());

        $textFieldX = $pdf->GetX() + 30;
        $pdf->SetXY(87.5, 31);

        // Add text to the cell "No Surat Pesan"
        $pdf->Cell(105, 8, 'Tanggal Pesan        : ', 1, 0, 'L');

        // Set the X position to the saved position and add the text field
        $pdf->SetX($textFieldX);
        $pdf->SetXY(124.5, 31);
        $pdf->TextField('field_tgl_pesan', 68, 8, array('value' => '....................'), array());

        $pdf->Ln(8);

        $textFieldX = $pdf->GetX() + 30;
        $pdf->SetXY(87.5, 39);

        // Add text to the cell "No Surat Pesan"
        $pdf->Cell(105, 8, 'Tanggal Negosiasi : ', 1, 0, 'L');

        // Set the X position to the saved position and add the text field
        $pdf->SetX($textFieldX);
        $pdf->Cell(79.5, 5, '');
        $pdf->TextField('field_tgl_negosiasi', 68, 8, array('value' => '....................'), array());

        $pdf->Ln(8);

        $pdf->Cell(2.5, 5, '');
        $pdf->Cell(175, 18, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(17.5, 47.5);
        $pdf->Cell(70, 8, 'WAKTU PENGERJAAN PESANAN :', 0, 0, 'L');
        $pdf->TextField('field_pengerjaan_psn', 105, 8, array('value' => '.......................'), array());

        $pdf->Ln(8);

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(17.5, 56.5);
        $pdf->Cell(70, 8, 'WAKTU PENGIRIMAN PESANAN :', 0, 0, 'L');
        $pdf->TextField('field_pengiriman_psn', 105, 8, array('value' => '.......................'), array());

        $pdf->Ln(8);

        $pdf->Cell(2.5, 5, '');
        $pdf->SetXY(17.5, 65);
        $pdf->Cell(175, 8, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(17.5, 65);
        $pdf->Cell(12, 8, 'RINCIAN PEKERJAAN', 0, 0, 'L');

        $pdf->Ln(8);

        $pdf->Cell(2.5, 5, '');
        $pdf->SetXY(17.5, 73);

        $header = array('No', 'Nama Barang / Jasa', 'Qty', 'Satuan', 'Harga Satuan (Rp)', 'Total Harga (Rp)');
        $columnWidths = array(10, 60, 10, 20, 40, 35);

        // Set background color for header
        $pdf->SetDrawColor(0, 0, 0); // Warna border hitam
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);

        // Add table headers
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($columnWidths[$i], 8, $header[$i], 1, 0, 'C', 1);
        }

        $pdf->Ln();
        $pdf->SetXY(17.5, 81);

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
            $pdf->SetXY(17.5, $pdf->GetY());
        }


        $pdf->Ln(8);

        $pdf->Cell(2.5, 5, '');
        $pdf->SetXY(17.5, 113);
        $pdf->Cell(175, 35, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(135.5, 114);
        $pdf->Cell(20, 6, 'PPN  Rp ', 0, 0, 'L');
        $pdf->TextField('field_ppn', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(8);

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(135.5, 120);
        $pdf->Cell(20, 8, 'PPh  Rp ', 0, 0, 'L');
        $pdf->TextField('field_pph', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(8);

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(112, 126);
        $pdf->Cell(43, 8, 'Biaya Pengiriman  Rp ', 0, 0, 'L');
        $pdf->TextField('field_biaya_pengiriman', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(8);

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(127, 132);
        $pdf->Cell(28, 8, 'Asuransi  Rp ', 0, 0, 'L');
        $pdf->TextField('field_asuransi', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(12);

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(112, 140);
        $pdf->Cell(43, 8, 'Total Pembayaran  Rp ', 0, 0, 'L');
        $pdf->TextField('field_total_pembayaran', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(8);

        $pdf->Cell(2.5, 5, '');
        $pdf->SetXY(17.5, 148);
        $pdf->Cell(175, 8, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(17.5, 148);
        $pdf->Cell(20, 8, 'Terbilang ', 0, 0, 'L');
        $pdf->SetXY(37, 149);
        $pdf->TextField('field_terbilang', 35, 6, array('value' => '...................'), array());

        $pdf->Ln(8);

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY(17.5, 156);
        $pdf->Cell(175, 67, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(17.5, 157);
        $pdf->SetMargins(23, 2, 23);

        $txt = '    Hak dan Kewajiban Penyedia dan Satuan Pendidikan
        1. Penyedia berkewajiban untuk menyediakan barang/jasa sesuai dengan surat pesanan dan dalam jangka waktu transaksi yang berlaku.
        2. Penyedia berhak memintakan pembayaran sesuai total pembayaran setelah penyelesaian pekerjaan yang dimintakan pada Surat Pesanan ini dan dibuktikan dengan Berita Acara Serah Terima.
        3. Pelaksana dalam kapasitas mewakili Satuan Pendidikan berhak untuk mendapatkan barang atau jasa sesuai Surat Pesanan ini.
        4. Pelaksana berhak menolak barang/jasa yang tidak sesuai dengan surat pesanan.
        5. Pelaksana dalam kapasitas mewakili Satuan Pendidikan berkewajiban untuk menyelesaikan pembayaran sesuai dengan mekanisme pembayaran yang berlaku pada sistem.
        6. Segala perselisihan yang timbul dari Surat Pesanan ini diselesaikan antara para pihak sesuai ketentuan yang berlaku.';

        $pdf->MultiCell(175, 8, $txt, 0, 'L');

        $pdf->Ln(8);

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY(17.5, 223);
        $pdf->Cell(175, 14, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(135, 227);

        $pdf->TextField('field_hari_ttd', 15, 6, array('value' => '................'), array());
        $pdf->Cell(2, 8, '');
        $pdf->TextField('field_tgl_ttd', 35, 6, array('value' => '.....................'), array());

        $pdf->Ln(8);

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY(17.5, 237);
        $pdf->Cell(87.5, 35, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(52, 241);
        $pdf->Cell(20, 8, 'Penyedia ', 0, 0, 'L');

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY(105, 237);
        $pdf->Cell(87.5, 35, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(142, 241);
        $pdf->Cell(20, 8, 'Pelaksana ', 0, 0, 'L');

    }

    public function generatePdf()
    {
        // Path untuk menyimpan hasil PDF yang dihasilkan
        $outputPdfPath = storage_path('app/results/surat_pemesanan.pdf');

        // Inisialisasi objek TCPDF dari FPDI
        $pdf = new Fpdi(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle('Surat Pemesanan');  // Judul dokumen

        $pdf->Cell(0, 10, 'Surat Pemesanan', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
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
        $pdf->Output($outputPdfPath, 'F');

        // Lakukan hal-hal lain sesuai kebutuhan, seperti memberikan hasil PDF sebagai respons
        return response()->file($outputPdfPath);
    }
}