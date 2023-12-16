<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Tcpdf\Fpdi;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Cache;

class BeritaAcaraSerahTerimaController extends Controller
{
    public function __construct()
    {
        $this->general_pdf = new PdfController();
    }
    public function textSurat($pdf)
    {
        $pdf->SetFont('times', 'B', 14);

        $pdf->Ln(5);
        $txt = 'Document Berita Acara Serah Terima';
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
        $pdf->SetFont('times', 12);
        $pdf->Cell(0.1, $rowHeight, '');
        $pdf->Cell(17, $rowHeight, 'Pada hari ini, ', 0, 0, 'L');
        $pdf->Cell($pdf->GetX() - 21, $rowHeight, '');
        $pdf->TextField('field_hari_ini', 15, $rowHeight, array('value' => '.......'));
        $pdf->Cell(10, $rowHeight, 'tanggal ', 0, 0, 'L');
        $pdf->Cell(7, $rowHeight, '');
        $pdf->TextField('field_tgl_ini', 10, $rowHeight, array('value' => '.......'));
        $pdf->Cell(10, $rowHeight, 'bulan ', 0, 0, 'L');
        $pdf->Cell(3, $rowHeight, '');
        $pdf->TextField('field_bulan_ini', 25, $rowHeight, array('value' => '.......'));
        $pdf->Cell(10, $rowHeight, 'tahun ', 0, 0, 'L');
        $pdf->Cell(3, $rowHeight, '');
        $pdf->TextField('field_thn_ini', 15, $rowHeight, array('value' => '.......'));
        $pdf->Cell(10, $rowHeight, 'sesuai', 0, 0, 'L');
        $pdf->Ln(8);
        $pdf->Cell(0.1, $rowHeight, '');
        $pdf->Cell(0.1, $rowHeight, 'dengan:', 0, 0, 'L');

        $pdf->Ln(12);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(15, 8, 'Nomor Surat Pesanan      :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_no_document', 90, 8, array('value' => '..............................................'));

        $pdf->Ln(12);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(15, 8, 'Tanggal                            :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_tgl_ini', 10, 8, array('value' => '..........', 'multiline' => false));  // TextField untuk tanggal
        $pdf->Cell(2);
        $pdf->TextField('field_bulan_ini', 25, 8, array('value' => '..........', 'multiline' => false));  // TextField untuk bulan
        $pdf->Cell(2);
        $pdf->TextField('field_thn_ini', 15, $rowHeight, array('value' => '.......'));

        $pdf->Ln(12);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(15, 8, 'Nama Pekerjaan               :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_nm_pekerjaan', 90, 8, array('value' => '...........................'));

        $pdf->Ln(12);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(15, 8, 'Tahun                               :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_thn_ini', 20, 8, array('value' => '.........'));

        $pdf->Ln(12);
        $txt = '<span style="text-align: justify; line-height: 1.5">Yang bertanda tangan dibawah ini: </span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');

        // $pdf->Cell($pdf->GetX(), $rowHeight, '');
        // $pdf->Cell(15, 8, 'Yang bertanda tangan dibawah ini: ');

        $pdf->Ln(2);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'Nama                        :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_nm', 97, 8, array('value' => '......................'));

        $pdf->Ln(10);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'Jabatan                      :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_jabatan', 97, 8, array('value' => '......................'));

        $pdf->Ln(10);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'Nama Perusahaan     :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_nm_perusahaan', 97, 8, array('value' => '......................'));

        $pdf->Ln(10);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'Alamat Perusahaan   :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_alamat_perusahaan', 97, 8, array('value' => '......................'));

        $pdf->Ln(10);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'No. Telephone          :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_no_telp', 45, 8, array('value' => '......................'));

        $pdf->Ln(10);
        $txt = '<span style="text-align: justify; line-height: 1.5">Sebagai pihak yang menyerahkan, selanjutnya disebut PIHAK PERTAMA</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        // $pdf->Cell($pdf->GetX(), $rowHeight, '');
        // $pdf->Cell(15, 8, 'Sebagai pihak yang menyerahkan, selanjutnya disebut PIHAK PERTAMA');

        $pdf->Ln(4);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'Nama                        :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_nm_satdik', 97, 8, array('value' => '......................'));

        $pdf->Ln(12);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'Jabatan                      :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_jabatan_satdik', 97, 8, array('value' => '......................'));

        $pdf->Ln(10);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'Nama Satdik             :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_nm_satdik', 97, 8, array('value' => '......................'));

        $pdf->Ln(10);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'Alamat Satdik           :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_alamat_satdik', 97, 8, array('value' => '......................'));

        $pdf->Ln(10);
        $pdf->Cell($pdf->GetX(), $rowHeight, '');
        $pdf->Cell(11, 8, 'No. Telephone          :');
        $pdf->Cell($pdf->GetX() - 4, $rowHeight, '');
        $pdf->TextField('field_no_telp_satdik', 45, 8, array('value' => '......................'));

        $pdf->Ln(10);
        $txt = '<span style="text-align: justify; line-height: 1.5">Sebagai pihak yang menerima, selanjutnya disebut PIHAK KEDUA</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        // $pdf->Cell(1, $rowHeight, '');
        // $pdf->Cell(15, 8, 'Sebagai pihak yang menerima, selanjutnya disebut PIHAK PERTAMA');

        $pdf->Ln(5);
        $txt = '<span style="text-align: justify; line-height: 1.5">PIHAK PERTAMA menyerahkan hasil pekerjaan</span>';
        $posYBeforeHTML = $pdf->GetY();
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'J');
        $posXAfterHTML = $pdf->GetX();

        // Tentukan posisi X dan Y untuk textfield
        $textFieldX = $posXAfterHTML + 100; // Sesuaikan posisi X dengan kebutuhan
        $textFieldY = $posYBeforeHTML;

        // Set posisi untuk menambahkan textfield
        $pdf->SetXY($textFieldX, $textFieldY);

        // Tambahkan textfield di samping teks HTML
        $pdf->TextField('field_nm_pekerjaan', 45, 6, array('value' => '......................'));
        $pdf->Cell(1);
        $pdf->Ln(7);
        $txt = '<span style="text-align: justify; line-height: 1.5">Kepada PIHAK 
        PERTAMA dan PIHAK KEDUA telah menerima hasil pekerjaan tersebut dalam jumlah yang lengkap dan kondisi yang baik sesuai dengan rincian berikut:</span>';
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'L');
        //$pdf->Ln();
        $txt = '<span style="text-align: justify; line-height: 1.5"></span>';
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('times', 12);
        $pdf->SetMargins(15, 15, 15);
        $header = array('No', 'Nama Barang/Jasa', 'Jumlah Dipesan', 'Jumlah Diterima Baik', 'Jumlah Diterima Rusak/Tidak Diterima');
        $columnWidths = array(10, 40, 34, 48, 40);

        // Set background color for header
        $pdf->SetDrawColor(0, 0, 0); // Warna border hitam
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);

        // Add table headers
        for ($i = 0; $i < count($header); $i++) {
            $colWidth = $columnWidths[$i];
            $colText = $header[$i];

            // Hitung tinggi maksimum untuk kolom ini
            $maxHeight = $pdf->getStringHeight($colWidth, $colText);

            // Gunakan MultiCell hanya jika tinggi konten lebih dari satu baris
            if ($maxHeight > 14) {
                $pdf->MultiCell($colWidth, 8, $colText, 1, 0, 'L', 1);
                //if ()
            } else {
                $pdf->Cell($colWidth, $maxHeight + 12.5, $colText, 1, 0, 'L', 1);
            }
            //$pdf->SetX($startX + $colWidth);

        }
        $sample_data = array(
            array('1', 'Barang A', '5', '5', '0'),
            array('2', 'Barang B', '3', '3', '0'),
            array('4', 'Barang C', '3', '2', '1'),
            array('5', 'Barang D', '3', '1', '2'),
            // ... tambahkan data sesuai kebutuhan
        );
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
        $txt = '<span style="text-align: justify; line-height: 1.5">Berita Acara Serah Terima ini berfungsi sebagai bukti serah terima hasil pekerjaan kepada PIHAK KEDUA, untuk selanjutnya dicatat pada buku penerimaan barang Satuan Pendidikan</span>';
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'L');
        $pdf->Ln(5);
        $txt = '<span style="text-align: justify; line-height: 1.5">Demikian Berita Acara Serah Terima ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana seharusnya.</span>';
        // Tambahkan teks ke PDF dengan format HTML
        $pdf->writeHTML($txt, true, false, false, false, 'L');
        $pdf->Ln(8);
        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY(17.5, 125);
        $pdf->Cell(87.5, 35, '', 0, 0, 'L');

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(5, 8, '');
        $pdf->SetXY(43, 135);
        $pdf->Cell(20, 8, 'PIHAK KEDUA ', 0, 0, 'L');
        $pdf->Ln(8);
        $pdf->Cell(19, 8, '');
        $pdf->SetFont('times', 12);
        $pdf->TextField('field_nm_pihak2', 48, 8, array('value' => '            ...................'), array());

        $pdf->Cell(2.5, 8, '');
        $pdf->SetXY(105, 125);
        $pdf->Cell(87.5, 35, '', 0, 0, 'L');

        $pdf->Cell(5, 8, '');
        $pdf->SetXY(126, 136);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(20, 8, 'PIHAK PERTAMA ', 0, 0, 'L');
        $pdf->SetFont('times', 12);
        $pdf->Ln(8);
        $pdf->Cell(105, 8, '');
        $pdf->SetFont('times', 12);
        $pdf->TextField('field_nm_pihak1', 48, 8, array('value' => '            ...................'), array());

        $pdf->Ln(30);
        $pdf->Cell(10, 8, '');
        $pdf->Cell(20, 8, 'NIP ', 0, 0, 'L');
        $pdf->SetXY(38, 175);
        $pdf->TextField('field_nip2', 40, 6, array('value' => '...................'), array());
        $pdf->SetXY(123, 175);
        $pdf->TextField('field_nip1', 40, 6, array('value' => '...................'), array());


        $pdf->Cell(5, 8, '');
        $pdf->SetXY(73, 185);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(20, 8, 'PEMERIKSAAN BARANG ', 0, 0, 'L');
        $pdf->SetFont('times', 12);
        $pdf->Ln(8);
        $pdf->Cell(60, 8, '');
        $pdf->SetFont('times', 12);
        $pdf->TextField('field_nm_pemeriksa_brng', 48, 8, array('value' => '            ...................'), array());

        $pdf->Ln(30);
        $pdf->Cell(50, 8, '');
        $pdf->Cell(20, 8, 'NIP ', 0, 0, 'L');
        $pdf->SetXY(76, 224);
        $pdf->TextField('field_nip3', 40, 6, array('value' => '...................'), array());

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
                    'Content-Disposition' => 'inline; filename="berita_acara_serah_terima.pdf"'
                ]);
            }
            $outputPdfPath = storage_path('app/results/berita_acara_serah_terima.pdf');

            // Inisialisasi objek TCPDF dari FPDI
            $pdf = new Fpdi(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetTitle('Document Berita Acara Serah Terima');  // Judul dokumen

            $pdf->Cell(0, 10, 'Document Berita Acara Serah Terima', 0, false, 'C', 0, '', 0, false, 'M', 'M');

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
                'Content-Disposition' => 'inline; filename="berita_acara_serah_terima.pdf"'
            ]);

        } catch (\Exception $e) {
            // Tangani kesalahan caching
            // Contoh: Log kesalahan atau kembalikan respons dengan pesan kesalahan
            return response("Gagal menyimpan ke cache: " . $e->getMessage(), 500);
        }
    }
}