<?php

namespace App\Exports;

use App\Models\CareerApplicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ApplicantsExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $careerId;
    protected $applicants;

    public function __construct($careerId)
    {
        $this->careerId = $careerId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Export for specific career
        $this->applicants = CareerApplicant::with(['career', 'experienced_applicant'])
            ->where('career_id', $this->careerId)
            ->orderBy('created_at', 'asc')
            ->get();

        return $this->applicants;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Career Position',
            'Career Location',
            'Applicant Name',
            'Email',
            'Phone Number',
            'Birth of Date',
            'Education',
            'Experienced',
            'Current Salary',
            'Expectation Salary',
            'Status',
            'Reject Reason',
            'Applied Date',

            // Experience Details
            'Company Name',
            'Industry',
            'Position',
            'Duration',
        ];
    }

    /**
     * @param mixed $applicant
     * @return array
     */
    public function map($applicant): array
    {
        static $counter = 0;
        $counter++;

        return [
            $counter,
            $applicant->career ? $applicant->career->position : 'N/A',
            $applicant->career ? $applicant->career->location : 'N/A',
            $applicant->first_name . ' ' . $applicant->last_name,
            $applicant->email,
            $applicant->phone_number,
            $applicant->bod ? $applicant->bod->format('d/m/Y') : 'N/A',
            $applicant->education,
            $applicant->experienced,
            $applicant->current_salary ? 'Rp ' . number_format($applicant->current_salary, 0, ',', '.') : 'N/A',
            $applicant->expectation_salary ? 'Rp ' . number_format($applicant->expectation_salary, 0, ',', '.') : 'N/A',
            ucfirst($applicant->status),
            $applicant->reject_reason ?: 'N/A',
            $applicant->created_at->format('d/m/Y H:i'),

            // Experience Details
            $applicant->experienced_applicant ? $applicant->experienced_applicant->company_name : 'N/A',
            $applicant->experienced_applicant ? $applicant->experienced_applicant->industry : 'N/A',
            $applicant->experienced_applicant ? $applicant->experienced_applicant->position : 'N/A',
            $applicant->experienced_applicant ? $applicant->experienced_applicant->duration . ' Month' : 'N/A',
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 20,  // Career Position
            'C' => 15,  // Career Location
            'D' => 20,  // Applicant Name
            'E' => 25,  // Email
            'F' => 15,  // Phone Number
            'G' => 12,  // Birth of Date
            'H' => 15,  // Education
            'I' => 16,  // Experienced
            'J' => 15,  // Current Salary
            'K' => 15,  // Expectation Salary
            'L' => 10,  // Status
            'M' => 20,  // Reject Reason
            'N' => 17,  // Applied Date
            'O' => 26,  // Company Name
            'P' => 15,  // Industry
            'Q' => 20,  // Position
            'R' => 12,  // Duration
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Style the header row
        $sheet->getStyle('A1:R1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '366092'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Set row height for header
        $sheet->getRowDimension('1')->setRowHeight(25);

        // Auto-size all columns
        foreach (range('A', 'R') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(false);
        }

        // Add borders to all data
        $lastRow = $this->applicants->count() + 1;
        $sheet->getStyle('A1:R' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        return [
            // Make first row bold
            1 => ['font' => ['bold' => true]],
        ];
    }
}