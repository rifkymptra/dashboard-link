<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Collection;

class LinkExport
{
    protected $links;

    public function __construct(Collection $links)
    {
        $this->links = $links;
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan header
        $sheet->setCellValue('A1', 'Judul');
        $sheet->setCellValue('B1', 'Deskripsi');
        $sheet->setCellValue('C1', 'Kategori');
        $sheet->setCellValue('D1', 'URL');

        // Menambahkan data
        $row = 2;
        foreach ($this->links as $link) {
            $sheet->setCellValue("A{$row}", $link->link_name);
            $sheet->setCellValue("B{$row}", $link->description_link);
            $sheet->setCellValue("C{$row}", $link->submittedBy->section->section_name);
            $sheet->setCellValue("D{$row}", $link->url);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'links.xlsx';
        $filepath = storage_path("app/public/{$filename}");

        $writer->save($filepath);

        return $filepath;
    }
}
