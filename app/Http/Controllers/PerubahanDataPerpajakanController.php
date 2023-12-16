<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Tcpdf\Fpdi;

class PerubahanDataPerpajakanController extends Controller
{
    private function textSurat($pdf)
    {
        $pdf->SetFont('times', 'B', 14);

        $pdf->Ln(5);
        $txt = 'Surat Perubahan Data Perpajakan Atas Proforma Invoice atau Invoice';
        $pdf->MultiCell(0, 0, $txt, 0, 'C', false);
        $pdf->SetFont('times', 8);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetXY($pdf->GetX(), $pdf->GetY());
        $docWidth = $pdf->getPageWidth();
        $rowHeight = 8;
        $pdf->SetY($pdf->GetY() + $rowHeight - 5);

        // Hitung posisi X untuk meletakkan elemen di tengah horizontal
        $xCentered = ($docWidth - 10 - 25) / 2;

        // Pindahkan ke posisi X yang sudah dihitung
        $pdf->SetX($xCentered - 17);

        $pdf->Cell(10, $rowHeight, 'No', 0, 0, 'L');
        // Letakkan TextField
        $pdf->TextField('field_no_document', 55, $rowHeight, array('value' => '..............................'));

        $pdf->Ln(15);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'Kepada', 0, 0, 'L');
        $pdf->Ln(6);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'Kepala Pusat Data dan Teknologi Informasi', 0, 0, 'L');
        $pdf->Ln(6);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', 0, 0, 'L');
        $pdf->Ln(6);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 5, 'ditempat,', 0, 0, 'L');

        $pdf->Ln(10);
        $pdf->SetFont('times', 12);
        $txt = '<span style="text-align:justify;line-height: 1.5;"> Pada hari </span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();

        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 18; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);
        $pdf->TextField('field_hari', 13, 6, array('value' => '..........'));
        $pdf->Cell(10, 6, 'tanggal', 0, 0, 'L');
        $pdf->Cell(5, 5, '');
        $pdf->TextField('field_tgl', 35, 6, array('value' => '..........'));
        $pdf->Cell(10, 6, 'bertempat di', 0, 0, 'L');
        $pdf->Cell(13, 5, '');
        $pdf->TextField('field_tmpt', 55, 6, array('value' => '..........'));
        $txt = '<span style="text-align:justify;line-height: 1.5;"> Mitra</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $pdf->Ln();
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() - 5);
        $txt = '<span style="text-align:justify;line-height: 1.5;"> Marketplace SIPLah</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();

        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 38; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);
        $pdf->TextField('field_marketplace', 35, 6, array('value' => '..........'));
        $pdf->Cell(10, 6, 'yang diwakili oleh', 0, 0, 'L');
        $pdf->Cell(24, 5, '');
        $pdf->TextField('field_nm', 50, 6, array('value' => '..........'));
        $txt = '<span style="text-align:justify;line-height: 1.5;"> selaku</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 1);
        $pdf->TextField('field_jabatan', 35, 6, array('value' => '..........'));
        //$pdf->SetXY($pdf->GetX(), $pdf->GetY() + 1);
        $pdf->Cell(10, 6, ' dan berhak untuk bertindak atas nama perusahaan,  mengajukan  permohonan', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 1);

        $pdf->SetMargins(15, 15, 15);
        $pdf->Cell(10, 6, 'perubahan  data  perpajakan pada proforma invoice/invoice atas transaksi dengan kondisi (silahkan', 0, 0, 'L');
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 1);
        $pdf->Ln();
        $pdf->Cell(10, 6, 'pilih salah satu/keduanya untuk yang relevan):', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 3);
        $pdf->Cell(10, 6, '         1. Ditemukan data perpajakan salah / kurang yang berakibat pada kegagalan pengiriman data', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 1);
        $pdf->Cell(10, 6, '             transaksi ke Direktorat Jenderal Pajak;', 0, 0, 'L');

        $pdf->Ln(2);
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 4);
        $pdf->Cell(10, 6, '         2. Mendapatkan  laporan   dari   satuan   pendidikan   bahwa  terdapat   perubahan  informasi', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 1);
        $pdf->Cell(10, 6, '             perpajakan.', 0, 0, 'L');

        $pdf->Ln(4);
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 6);
        $pdf->Cell(5, 6, 'Atas  salah  satu / seluruh  kondisi  tersebut  kami  butuh  memperbarui  informasi  pada dokumen', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 1);
        $pdf->Cell(5, 6, 'proforma  invoice / invoice  transaksi  yang  sudah teridentifikasi. Untuk kebutuhan pembaharuan', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 1);
        $pdf->Cell(5, 6, 'ini, kami  memohon  diberikan  data  perpajakan  berupa  NPWP  Satuan Pendidikan yang terbaru', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 1);
        $pdf->Cell(5, 6, 'untuk yang data sebagai berikut:', 0, 0, 'L');

        $pdf->Ln(13);

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY($pdf->getX() + 3, $pdf->GetY());
        $pdf->Cell(77.5, 15, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->Ln(5);
        $pdf->SetXY(23, $pdf->GetY() - 4);
        $pdf->Cell(12, 8, 'Transaksi yang teridentifikasi memenuhi', 0, 0, 'L');
        $pdf->Ln(4);
        $pdf->SetXY(52, $pdf->GetY() + 1);
        $pdf->Cell(12, 8, 'kondisi', 0, 0, 'L');

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY(98, $pdf->GetY() - 6);
        $pdf->Cell(77.5, 15, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(105, $pdf->GetY() + 1);
        $pdf->Cell(12, 8, 'Data Perpajakan Satuan Pendidikan', 0, 0, 'L');
        $pdf->Ln(4);
        $pdf->SetXY(114, $pdf->GetY() + 1);
        $pdf->Cell(12, 8, 'yang butuh pembaharuan', 0, 0, 'L');

        $pdf->Ln(8);

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY($pdf->GetX() + 3, $pdf->GetY() + 1);
        $pdf->Cell(38.75, 20, '', 1, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(33, $pdf->GetY() + 1);
        $pdf->Cell(10, 8, 'Nomor', 0, 0, 'L');
        $pdf->Ln(4);
        $pdf->SetXY(22, $pdf->GetY() + 1);
        $pdf->Cell(12, 8, 'Invoice / Proforma', 0, 0, 'L');
        $pdf->Ln(4);
        $pdf->SetXY(32, $pdf->GetY() + 1);
        $pdf->Cell(12, 8, 'Invoice', 0, 0, 'L');

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY($pdf->GetX() + 12.8, $pdf->GetY() - 11);
        $pdf->Cell(38.75, 20, '', 1, 0, 'L');
        $pdf->Cell(5, 8, '');
        $pdf->SetXY(62, $pdf->GetY() + 6);
        $pdf->Cell(10, 8, 'transaction_mpid', 0, 0, 'L');

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY($pdf->GetX() + 23.5, $pdf->GetY() - 6);
        $pdf->Cell(38.75, 20, '', 1, 0, 'L');
        $pdf->Cell(5, 8, '');
        $pdf->SetXY(99, $pdf->GetY() + 6);
        $pdf->Cell(10, 8, 'Nama Sekolah', 0, 0, 'L');

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY($pdf->GetX() + 25.2, $pdf->GetY() - 6);
        $pdf->Cell(38.75, 20, '', 1, 0, 'L');
        $pdf->Cell(5, 8, '');
        $pdf->SetXY(144, $pdf->GetY() + 6);
        $pdf->Cell(10, 8, 'NPSN', 0, 0, 'L');

        $pdf->Ln(8);

        $pdf->Cell(4, 8, '');
        $pdf->SetXY($pdf->GetX() + 1.5, $pdf->GetY() + 6);
        $pdf->Cell(38.75, 8, '', 1, 0, 'L');

        $pdf->Cell(8, 8, '');
        $pdf->SetXY(20.5, $pdf->GetY());
        $pdf->TextField('field_no_invoice', 38.75, 8, array('value' => '..........'));

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY($pdf->GetX() - 2.5, $pdf->GetY());
        $pdf->Cell(38.75, 8, '', 1, 0, 'L');
        $pdf->Cell(5, 8, '');
        $pdf->SetXY(59.3, $pdf->GetY());
        $pdf->TextField('field_transaction_mpid', 38.75, 8, array('value' => '..........'));

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY($pdf->GetX() - 2.5, $pdf->GetY());
        $pdf->Cell(38.75, 8, '', 1, 0, 'L');
        $pdf->Cell(5, 8, '');
        $pdf->SetXY(98, $pdf->GetY());
        $pdf->TextField('field_nm_sekolah', 38.75, 8, array('value' => '..........'));

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY($pdf->GetX() - 2.5, $pdf->GetY());
        $pdf->Cell(38.75, 8, '', 1, 0, 'L');
        $pdf->Cell(5, 8, '');
        $pdf->SetXY(136.7, $pdf->GetY());
        $pdf->TextField('field_transaction_mpid', 38.75, 8, array('value' => '..........'));

        $pdf->Ln(8);
        $pdf->SetXY($pdf->GetX() + 2, $pdf->GetY() + 6);
        $pdf->Cell(5, 6, 'Demikian permohonan kami, atas perhatian dan kerjasamanya kami ucapkan terima kasih.', 0, 0, 'L');

        $pdf->Ln(12);

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY(92, $pdf->GetY());
        $pdf->Cell(87.5, 35, '', 0, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(75, $pdf->GetY());
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(20, 8, 'Mitra Marketplace SIPLah', 0, 0, 'L');
        $pdf->SetXY(128, $pdf->GetY() + 1);
        $pdf->TextField('field_mitra_siplah', 50, 6, array('value' => '[Nama PT............]'));


        $pdf->Ln(12);
        $pdf->SetFont('times', 'I', 10);
        $pdf->SetXY(170, $pdf->GetY() + 1);
        $pdf->Cell(20, 8, 'Ttd', 0, 0, 'L');

        $pdf->Ln(13);
        $pdf->SetFont('times', 12);
        $pdf->SetXY(113, $pdf->GetY() + 1);
        $pdf->TextField('field_nama_jabatan', 65, 6, array('value' => '(Nama dan Jabatan)'));
    }

    public function generatePdf()
    {
        // Path untuk menyimpan hasil PDF yang dihasilkan
        $outputPdfPath = storage_path('app/results/surat_perubahan_data_perpajakan.pdf');

        // Inisialisasi objek TCPDF dari FPDI
        $pdf = new Fpdi(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle('Surat Perubahan Data Perpajakan Proforma Invoice atau Invoice');  // Judul dokumen

        $pdf->Cell(0, 10, 'Surat Perubahan Data Perpajakan Proforma Invoice atau Invoice', 0, false, 'C', 0, '', 0, false, 'M', 'M');

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