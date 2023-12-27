<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Cache;

class BeritaAcaraNegosiasiController extends Controller
{
    private function textSurat($pdf)
    {
        $pdf->SetFont('times', 'B', 14);

        $txt = 'Document Berita Acara Negosiasi';
        $pdf->MultiCell(0, 17, $txt, 0, 'C', false);
        $pdf->SetFont('times', 12);

        $pdf->Cell(63, 8, 'Nama Satuan Pendidikan      :');
        $pdf->TextField('field_nm_satdik', 115, 8, array('value' => '................................................................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(63, 8, 'Alamat Satuan Pendidikan    :');
        $pdf->TextField('field_almt1_satdik', 115, 8, array('value' => '................................................................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit
        $pdf->Cell(63, 8, '');
        $pdf->TextField('field_almt2_satdik', 115, 8, array('value' => '................................................................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(63, 8, 'Nama Calon Penyedia           :');
        $pdf->TextField('field_nm_calon_penyedia', 115, 8, array('value' => '................................................................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(63, 8, 'Alamat Calon Penyedia         :');
        $pdf->TextField('field_almt1_penyedia', 115, 8, array('value' => '................................................................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit
        $pdf->Cell(63, 8, '');
        $pdf->TextField('field_almt2_penyedia', 115, 8, array('value' => '................................................................'));

        $pdf->Ln(10); // Baris baru dengan jarak 10 unit

        $pdf->Cell(63, 8, 'Tanggal Terima Barang/Jasa :');
        $pdf->TextField('field_tgl_terima', 35, 8, array('value' => '........'));

        $pdf->Ln(12);
        $pdf->Cell($pdf->GetX(), 8, 'Hasil Negosiasi');

        $pdf->Ln(10);
        $pdf->SetFont('times', 12);

        $header = array('No', 'Nama Produk', 'Qty', 'Harga Penawaran', 'Harga Negosiasi', 'Keterangan');
        $columnWidths = array(10, 50, 10, 40, 40, 30);

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
            array('1', 'Barang A', '5', '100000', '50000', '-'),
            array('2', 'Barang B', '3', '150000', '75000', '-'),
            array('4', 'Barang C', '3', '150000', '75000', '-'),
            array('5', 'Barang D', '3', '150000', '75000', '-'),
            array('6', 'Barang D', '3', '150000', '75000', '-'),
            array('7', 'Barang D', '3', '150000', '75000', '-'),
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
        $header = array('Biaya Pengiriman', '', 'Kg', 'Total Harga', 'Rp', '');
        $columnWidths = array(60, 15, 10, 30, 10, 55);

        // Set background color for header
        $pdf->SetDrawColor(0, 0, 0); // Warna border hitam
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);

        // Add table headers
        for ($i = 0; $i < count($header); $i++) {
            if ($header[$i] == '') {
                $uniqueId = uniqid();
                $fieldName = 'field_lst' . $uniqueId . '_' . $i;
                $pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'solid' => 255, 'color' => array(255, 255, 255)));

                $pdf->SetDrawColor(0, 0, 0); // Warna border hitam
                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell($columnWidths[$i], 8, '', 1); // Placeholder untuk body tabel
                $pdf->SetXY($pdf->GetX() - $columnWidths[$i], $pdf->GetY());
                $pdf->TextField($fieldName, $columnWidths[$i], 8);
            } else {
                $pdf->Cell($columnWidths[$i], 8, $header[$i], 1, 0, 'C', 1);
            }
        }
        $pdf->Ln(20);

        $pdf->Cell(110, 8, '');
        $pdf->TextField('field_hari_ttd', 15, 6, array('value' => '................'), array());
        $pdf->Cell(2, 8, '');
        $pdf->TextField('field_tgl_ttd', 35, 6, array('value' => '.....................'), array());

        $pdf->Ln(15);

        $pdf->Cell(30, 8, '');
        $pdf->Cell(12, 8, 'Pelaksana');
        $pdf->Cell(70, 8, '');
        $pdf->Cell(12, 8, 'Calon Penyedia');

        $pdf->Ln(30);

        $pdf->Cell(105, 8, '');
        $pdf->TextField('field_ttd_calon_penyedia', 50, 6, array('value' => '................'), array());
        $pdf->Ln(8);
        $pdf->Cell(15, 8, '');
        $pdf->TextField('field_ttd_pelaksana', 50, 6, array('value' => '           ................'), array());
        $pdf->Cell(39, 8, '');
        $pdf->Cell(10, 8, 'NIP');
        $pdf->TextField('field_ttd_calon_penyedia', 50, 6, array('value' => '................'), array());

    }
    public function generatePdf()
    {
        $outputPdfPath = storage_path('app/results/berita_acara_negosiasi.pdf');

        $cacheKey = 'pdf_cache_' . uniqid();
        try {
            // Mengecek apakah PDF sudah ada di cache
            if (Cache::has($cacheKey)) {
                $pdfOutput = Cache::get($cacheKey);
                return response($pdfOutput, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="berita_acara_negosiasi.pdf"'
                ]);
            }
            $outputPdfPath = storage_path('app/results/berita_acara_negosiasi.pdf');

            // Inisialisasi objek TCPDF dari FPDI
            $pdf = new Fpdi(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetTitle('Document Berita Acara Negosiasi');  // Judul dokumen

            $pdf->Cell(0, 10, 'Document Berita Acara Negosiasi', 0, false, 'C', 0, '', 0, false, 'M', 'M');

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
            $pdfOutput = $pdf->Output('', 'S');
            Cache::put($cacheKey, $pdfOutput, now()->addHours(9999));

            return response(Cache::get($cacheKey), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="berita_acara_negosiasi.pdf"'
            ]);

        } catch (\Exception $e) {
            // Tangani kesalahan caching
            // Contoh: Log kesalahan atau kembalikan respons dengan pesan kesalahan
            return response("Gagal menyimpan ke cache: " . $e->getMessage(), 500);
        }
    }
}