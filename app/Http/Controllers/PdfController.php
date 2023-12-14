<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Tcpdf\Fpdi;

class PdfController extends Controller
{
    public function createBingkai($pdf)
    {
        $pageWidth = $pdf->getPageWidth();

        // Set rectangle dimensions
        $rectWidth = 175;
        $rectHeight = 257;

        // Calculate x-coordinate to center the rectangle horizontally
        $xCoordinate = ($pageWidth - $rectWidth) / 2;
        $pdf->Rect($xCoordinate, 15, $rectWidth, $rectHeight, 'D');
    }
    public function createTable($pdf, $header, $columnWidths, $total_row)
    {
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
        $sample_data = array();
        for ($j = 0; $j < $total_row; $j++) {
            $val = array($j + 1, 'Barang A', '5', '100000', '50000', '-');
            array_push($sample_data, $val);
        }

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
    }

}