<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Tcpdf\Fpdi;

class SuratPemesananController extends Controller
{
    private function textSurat($pdf)
    {
        $pageWidth = $pdf->getPageWidth();
        $pageHeight = $pdf->getPageHeight();

        // Set rectangle dimensions
        $rectWidth = 135;
        $rectHeight = 250;

        // Calculate x-coordinate to center the rectangle horizontally
        $xCoordinate = ($pageWidth - $rectWidth) / 2;

        // Draw the main rectangle
        $pdf->Rect($xCoordinate, 10, $rectWidth, $rectHeight, 'D');


        // Set font
        $pdf->SetFont('times', '', 12);

        // Set the position for Multicell
        $multicellX = $xCoordinate; // Adjust the position as needed
        $multicellY = 10; // Adjust the position as needed

        // Set cell padding
        $padding = 0;

        // Set cell height
        $cellHeight = 0;


        // Calculate dimensions for the two side-by-side boxes
        $boxWidth = ($rectWidth - 3 * $padding) / 2;
        // Draw the first box
        $pdf->Rect($multicellX + $padding, $multicellY + $cellHeight + $padding, $boxWidth, 12, 'D');

        // Draw the second box
        $pdf->Rect($multicellX + $padding + $boxWidth + $padding, $multicellY + $cellHeight + $padding, $boxWidth, 12, 'D');

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
        $pdf->Output($outputPdfPath, 'F');

        // Lakukan hal-hal lain sesuai kebutuhan, seperti memberikan hasil PDF sebagai respons
        return response()->file($outputPdfPath);
    }
}