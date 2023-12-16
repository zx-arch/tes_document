<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Tcpdf\Fpdi;
use App\Http\Controllers\PdfController;

class ProformaInvoiceController extends Controller
{
    public function __construct()
    {
        $this->general_pdf = new PdfController();
    }
    private function createBingkai($pdf)
    {

        $pageWidth = $pdf->getPageWidth();

        // Set rectangle dimensions
        $rectWidth = 180;
        $rectHeight = 165;

        // Calculate x-coordinate to center the rectangle horizontally
        $xCoordinate = ($pageWidth - $rectWidth) / 2;
        $pdf->Rect($xCoordinate, 15, $rectWidth, $rectHeight, 'D');
        $pdf->SetFont('times', 'B', 14);

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $txt = 'PROFORMA INVOICE';
        $pdf->MultiCell(0, 0, $txt, 0, 'L', false);

        $imagePath = public_path('img/siplah_icon.png');

        // Tentukan posisi dan ukuran gambar
        $x = $pdf->GetX() + 140; // Ganti dengan koordinat X yang diinginkan
        $y = $pdf->GetY() - 10; // Ganti dengan koordinat Y yang diinginkan
        $width = 30; // Ganti dengan lebar gambar yang diinginkan
        $height = 0; // Tinggi akan diatur otomatis sesuai rasio aspek gambar

        // Tambahkan gambar ke PDF
        $pdf->Image($imagePath, $x, $y, $width, $height);
    }
    private function textSurat($pdf)
    {
        $this->createBingkai($pdf);
        $pdf->Ln(8);
        $pdf->SetFont('times', 'B', 12);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->TextField('field_nm_pt', 58, 6, array('value' => 'PT Nama Mitra'), array());
        $pdf->SetXY($pdf->GetX() + 10, $pdf->GetY());
        $pdf->Cell(25, 6, 'Proforma Invoice No. ', 0, 0, 'L');
        $pdf->Cell(17, 6, '');
        $pdf->TextField('field_no_invoice', 56, 6, array('value' => '......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(10, 6, 'NPWP', 0, 0, 'L');
        $pdf->Cell(5, 6, '');
        $pdf->TextField('field_npwp', 43, 6, array('value' => '.......'), array());
        $pdf->SetXY($pdf->GetX() + 15, $pdf->GetY());
        $pdf->Cell(25, 6, 'Tanggal Dokumen ', 0, 0, 'L');
        $pdf->Cell(13, 6, '');
        $pdf->TextField('field_tgl_document', 35, 6, array('value' => '......'), array());

        $pdf->Ln(15);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(10, 6, 'Dari Penyedia', 0, 0, 'L');
        $pdf->SetXY($pdf->GetX() + 68, $pdf->GetY());
        $pdf->Cell(12, 6, 'Untuk Satdik', 0, 0, 'L');

        $pdf->Ln(8);
        $pdf->SetFont('times', 12);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(12, 6, 'Nama', 0, 0, 'L');
        $pdf->Cell(4, 6, '');
        $pdf->TextField('field_nm_penyedia', 55, 6, array('value' => '.......'), array());
        $pdf->SetXY($pdf->GetX() + 5, $pdf->GetY());
        $pdf->Cell(12, 6, 'Nama Perwakilan', 0, 0, 'L');
        $pdf->Cell(21, 6, '');
        $pdf->TextField('field_nm_perwakilan_satdik', 55, 6, array('value' => '......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(12, 6, 'Alamat', 0, 0, 'L');
        $pdf->Cell(4, 6, '');
        $pdf->TextField('field_alamat_penyedia1', 55, 6, array('value' => '.......'), array());
        $pdf->SetXY($pdf->GetX() + 10, $pdf->GetY());
        $pdf->Cell(12, 6, 'Nama Sekolah', 0, 0, 'L');
        $pdf->Cell(16, 6, '');
        $pdf->TextField('field_nm_sekolah', 55, 6, array('value' => '......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        //$pdf->Cell(2, 6, '');
        $pdf->TextField('field_alamat_penyedia1', 71, 6, array('value' => '.......'), array());
        $pdf->SetXY($pdf->GetX() + 10, $pdf->GetY());
        $pdf->Cell(12, 6, 'Alamat Satdik', 0, 0, 'L');
        $pdf->Cell(16, 6, '');
        $pdf->TextField('field_alamat_satdik1', 55, 6, array('value' => '......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(12, 6, 'Kontak', 0, 0, 'L');
        $pdf->Cell(4, 6, '');
        $pdf->TextField('field_kontak', 55, 6, array('value' => '.......'), array());
        $pdf->SetXY($pdf->GetX() + 8, $pdf->GetY());
        $pdf->Cell(3, 6, '');
        $pdf->TextField('field_alamat_satdik2', 82, 6, array('value' => '......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(12, 6, 'NPWP', 0, 0, 'L');
        $pdf->Cell(4, 6, '');
        $pdf->TextField('field_npwp_penyedia', 55, 6, array('value' => '.......'), array());
        $pdf->SetXY($pdf->GetX() + 10, $pdf->GetY());
        $pdf->Cell(12, 6, 'NPSN Satdik', 0, 0, 'L');
        $pdf->Cell(14, 6, '');
        $pdf->TextField('field_npsn_satdik', 57, 6, array('value' => '......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 88, $pdf->GetY());
        $pdf->Cell(12, 6, 'Kontak Satdik', 0, 0, 'L');
        $pdf->Cell(15, 6, '');
        $pdf->TextField('field_kontak_satdik', 56, 6, array('value' => '......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 88, $pdf->GetY());
        $pdf->Cell(12, 6, 'NPWP Satdik', 0, 0, 'L');
        $pdf->Cell(15, 6, '');
        $pdf->TextField('field_npwp_satdik', 56, 6, array('value' => '......'), array());

        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 12);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY() - 7);
        $pdf->Cell(10, 6, 'Jasa Kurir (Optional)', 0, 0, 'L');

        $pdf->Ln(8);
        $pdf->SetFont('times', 12);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(12, 6, 'Nama', 0, 0, 'L');
        $pdf->Cell(4, 6, '');
        $pdf->TextField('field_nm_kurir', 55, 6, array('value' => '.......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(12, 6, 'Alamat', 0, 0, 'L');
        $pdf->Cell(4, 6, '');
        $pdf->TextField('field_alamat_kurir1', 55, 6, array('value' => '.......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        //$pdf->Cell(2, 6, '');
        $pdf->TextField('field_alamat_kurir1', 71, 6, array('value' => '.......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(12, 6, 'Kontak', 0, 0, 'L');
        $pdf->Cell(4, 6, '');
        $pdf->TextField('field_kontak', 55, 6, array('value' => '.......'), array());

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(12, 6, 'NPWP', 0, 0, 'L');
        $pdf->Cell(4, 6, '');
        $pdf->TextField('field_npwp_kurir', 55, 6, array('value' => '.......'), array());

        $pdf->Ln(12);
        $xStart = $pdf->GetX() + 7;
        $xEnd = $pdf->GetX() + 170;
        $y = $pdf->GetY();

        // Tentukan ketebalan garis (dalam mm)
        $lineWidth = 0.2; // Ganti sesuai kebutuhan

        // Atur warna garis (RGB)
        $pdf->SetDrawColor(0, 0, 0); // Hitam

        // Gambar garis tegak lurus
        $pdf->SetLineWidth($lineWidth);
        $pdf->Line($xStart, $y, $xEnd, $y);

        $pdf->Ln(3);
        $pdf->SetFont('times', 'B', 12);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(10, 6, 'Batas Pembayaran', 0, 0, 'L');
        $pdf->Cell(30, 6, '');
        $pdf->Cell(5, 6, 'Bank', 0, 0, 'L');
        $pdf->Cell(12, 6, '');
        $pdf->Cell(5, 6, 'Cabang Bank', 0, 0, 'L');
        $pdf->Cell(25, 6, '');
        $pdf->Cell(5, 6, 'No. VA/No. Rek Tujuan', 0, 0, 'L');
        $pdf->Cell(45, 6, '');
        $pdf->Cell(5, 6, 'Atas Nama', 0, 0, 'L');

        $pdf->Ln(8);
        $pdf->SetFont('times', 'B', 12);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->TextField('field_bts_pembayaran', 35, 6, array('value' => '................'), array());
        $pdf->Cell(3, 6, '');
        $pdf->TextField('field_bank', 18, 6, array('value' => '.......'), array());
        $pdf->Cell(3, 6, '');
        $pdf->TextField('field_cabang_bank', 25, 6, array('value' => '.......'), array());
        $pdf->Cell(3, 6, '');
        $pdf->TextField('field_no_va/rek', 35, 6, array('value' => '.......'), array());
        $pdf->Cell(3, 6, '');
        $pdf->TextField('field_atas_nama', 42, 6, array('value' => '.......'), array());

        $pdf->Ln(12);
        $pdf->SetFont('times', 'B', 12);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->Cell(10, 6, 'Metode Pengiriman', 0, 0, 'L');
        $pdf->Cell(30, 6, '');
        $pdf->Cell(5, 6, 'Catatan Pengiriman', 0, 0, 'L');

        $pdf->Ln(8);
        $pdf->SetFont('times', 'B', 12);
        $pdf->SetXY($pdf->GetX() + 7, $pdf->GetY());
        $pdf->TextField('field_metode_pembayaran', 35, 6, array('value' => '................'), array());
        $pdf->Cell(5, 6, '');
        $pdf->TextField('field_catatan_pembayaran', 45, 6, array('value' => '.......'), array());

        $pdf->Ln(12);
        $xStart = $pdf->GetX() + 7;
        $xEnd = $pdf->GetX() + 170;
        $y = $pdf->GetY();

        // Tentukan ketebalan garis (dalam mm)
        $lineWidth = 0.2; // Ganti sesuai kebutuhan

        // Atur warna garis (RGB)
        $pdf->SetDrawColor(0, 0, 0); // Hitam

        // Gambar garis tegak lurus
        $pdf->SetLineWidth($lineWidth);
        $pdf->Line($xStart, $y, $xEnd, $y);

        $pdf->Ln(5);

        $pdf->SetFont('times', 12);
        //$pdf->SetMargins(15, 15, 5);
        $pdf->SetXY($pdf->GetX() + 2, $pdf->GetY());
        // $data = array(
        //     array('No', 'Nama Barang/Jasa', 'PPN Per Item', 'Jumlah Dipesan', 'Jumlah Diterima', 'Harga Sebelum PPN'),
        //     array('1', 'Produk A', 'Rp. 100.000', '5', '5', 'Rp. 100.000'),
        //     array('2', 'Produk B', 'Rp. 150.000', '5', '5', 'Rp. 100.000'),
        //     array('3', 'Produk C', 'Rp. 120.000', '5', '5', 'Rp. 100.000'),
        // );

        // // Tentukan lebar kolom
        // $columnWidths = array(7, 38, 28, 31, 32, 39);
        $header = array('No', 'Nama Barang/Jasa', 'PPN Per Item', 'Jumlah Dipesan', 'Jumlah Diterima', 'Harga Sebelum PPN');
        $columnWidths = array(7, 38, 28, 31, 32, 39);

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
            array('1', 'Produk A', 'Rp. 100.000', '5', '5', 'Rp. 100.000'),
            array('2', 'Produk B', 'Rp. 150.000', '5', '5', 'Rp. 100.000'),
            array('3', 'Produk C', 'Rp. 120.000', '5', '5', 'Rp. 100.000'),
            array('4', 'Produk D', 'Rp. 120.000', '5', '5', 'Rp. 100.000'),
            array('5', 'Produk E', 'Rp. 120.000', '5', '5', 'Rp. 100.000'),
            // ... tambahkan data sesuai kebutuhan
        );

        // Set font for data

        foreach ($sample_data as $row) {
            $pdf->SetXY($pdf->GetX() + 2, $pdf->GetY());
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
        $pdf->AddPage();
        $pdf->SetMargins(15, 15, 15);
        $this->createBingkai($pdf);
        $pdf->SetFont('times', 'B', 11);
        $pdf->Ln(10);

        $pdf->Cell(2.5, 5, '');
        $pdf->SetXY($pdf->GetX() + 1, $pdf->GetY());
        $pdf->Cell(172, 100, '', 1, 0, 'L');

        $pdf->Cell(45, 8, '');
        $pdf->SetXY(105, $pdf->GetY() + 2);
        $pdf->Cell(50, 6, 'DPP PPN (Barang/Jasa)  Rp ', 0, 0, 'L');
        $pdf->TextField('field_dpp_ppn', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(8);
        $pdf->Cell(123, 8, '');
        $pdf->Cell(17, 6, 'PPN  Rp ', 0, 0, 'L');
        $pdf->TextField('field_ppn_1', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(6);
        $pdf->Cell(45, 8, '');
        $pdf->SetXY(114, $pdf->GetY() + 2);
        $pdf->Cell(41, 6, 'DPP PPN (Ongkir)  Rp ', 0, 0, 'L');
        $pdf->TextField('field_dpp_ppn_ongkir', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(8);
        $pdf->Cell(120, 8, '');
        $pdf->Cell(20, 6, '* PPN  Rp ', 0, 0, 'L');
        $pdf->TextField('field_ppn_2', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(12);
        $pdf->SetFont('times', 'I', 9);
        $pdf->Cell(45, 8, '');
        $pdf->SetXY(100, $pdf->GetY() + 2);
        $pdf->Cell(35, 6, 'Harga PPN dikurangi terhadap harga barang dan biaya pengiriman', 0, 0, 'L');
        $pdf->Ln(3);
        $pdf->SetFont('times', 'I', 9);
        $pdf->Cell(45, 8, '');
        $pdf->SetXY(127, $pdf->GetY() + 2);
        $pdf->Cell(30, 6, '* optional jika terdapat pihak ketiga jasa kurir', 0, 0, 'L');

        $pdf->Ln(8);

        $pdf->SetFont('times', 'B', 11);
        $pdf->Cell(2.5, 5, '');
        $pdf->SetXY($pdf->GetX() + 1, $pdf->GetY() + 2);
        $pdf->Cell(172, 10, '', 1, 0, 'L');

        $pdf->Cell(8, 8, '');
        $pdf->SetXY(20, $pdf->GetY() + 2);
        $pdf->Cell(127, 6, 'GRAND TOTAL :', 0, 0, 'L');
        $pdf->Cell(10, 6, 'Rp.', 0, 0, 'L');
        $pdf->TextField('field_grand_total', 25, 6, array('value' => '...................'), array());

        $pdf->Ln(8);
        $pdf->Cell(43, 8, '');
        $pdf->SetXY(105, $pdf->GetY() + 2);
        $pdf->Cell(50, 6, 'DPP PPh (Barang/Jasa)  Rp ', 0, 0, 'L');
        $pdf->TextField('field_dpp_pph', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(8);
        $pdf->Cell(108, 8, '');
        $pdf->Cell(32, 6, 'PPh Pasal 22  Rp ', 0, 0, 'L');
        $pdf->TextField('field_pph_1', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(6);
        $pdf->Cell(45, 8, '');
        $pdf->SetXY(114, $pdf->GetY() + 2);
        $pdf->Cell(41, 6, 'DPP PPh (Ongkir)  Rp ', 0, 0, 'L');
        $pdf->TextField('field_dpp_ppn_ongkir', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(8);
        $pdf->Cell(106, 8, '');
        $pdf->Cell(34, 6, '* PPh Pasal 22 Rp ', 0, 0, 'L');
        $pdf->TextField('field_pph_2', 30, 6, array('value' => '...................'), array());

        $pdf->Ln(15);
        $pdf->SetFont('times', 11);
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 2);
        $txt = '<span style="text-align:justify;line-height: 1.5;">* Transaksi ini telah dipotong PPh Pasal 22 sebesar 0.5% kepada penyedia dan/atau mitra pengiriman dan nilai invoice diluar PPN.</span>';
        $pdf->writeHTML($txt, true, false, false, false, 'J');

        $pdf->Ln();
        $pdf->SetFont('times', 'B', 11);
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() - 2);
        $txt = '<span style="text-align:justify;line-height: 1.5;">Invoice ini berlaku sebagai dokumen yang ipersamakan dengan bukti pemotongan PPh Pasal 22 dan dokument tertentu yang kedudukannya dipersamakan dengan Faktur Pajak.</span>';
        $pdf->writeHTML($txt, true, false, false, false, 'J');
    }
    public function generatePdf()
    {
        // Path untuk menyimpan hasil PDF yang dihasilkan
        $outputPdfPath = storage_path('app/results/proforma_invoice.pdf');

        // Inisialisasi objek TCPDF dari FPDI
        $pdf = new Fpdi(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle('Proforma Invoice');  // Judul dokumen

        $pdf->Cell(0, 10, 'Proforma Invoice', 0, false, 'C', 0, '', 0, false, 'M', 'M');

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