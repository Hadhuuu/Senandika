<?php

namespace App\Exports;

use App\Models\Assessment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; 
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType; 
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class AntreanExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithCustomValueBinder
{
    protected $rowNumber = 0;

    public function collection()
    {
        return Assessment::with('user')->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama Mahasiswa',
            'Jurusan',
            'Skor CF',
            'Status',
            'Tanggal Pengajuan'
        ];
    }

    public function map($assessment): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $assessment->user->nim, // Nilai NIM asli
            $assessment->user->name,
            $assessment->user->course,
            $assessment->final_score . '%',
            $assessment->status,
            $assessment->created_at->format('d-m-Y')
        ];
    }

    /**
     * Memaksa kolom NIM (Kolom B) agar dibaca sebagai TEXT murni oleh Excel (Anti E-Notation)
     */
    public function bindValue(Cell $cell, $value)
    {
        // Jika berada di kolom B (NIM) dan bukan baris header (baris 1)
        if ($cell->getColumn() == 'B' && $cell->getRow() > 1) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }

    /**
     * Mewarnai Header Tabel dengan Hijau Khas Senandika biar cantik untuk Rektorat
     */
    public function styles(Worksheet $worksheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => '49715A'] 
                ]
            ],
        ];
    }
}