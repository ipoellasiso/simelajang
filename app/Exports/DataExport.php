<?php

namespace App\Exports;

Use App\Models\PajaklsModel;
Use App\Models\PotonganModel;
Use App\Models\BelanjalsguModel;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class DataExport implements WithStyles
{
    public function styles(Worksheet $sheet)
    {

        $style_col = [
            'font' => ['bold' => true],
            'aligment' => [
                'horizontal'=> \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top'       => ['borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right'     => ['borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom'    => ['borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left'      => ['borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $style_row = [
            'aligment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top'       => ['borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right'     => ['borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom'    => ['borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left'      => ['borderstyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $sheet->setCellValue('A1', "DATA PAJAK");
        $sheet->setCellValue('A2', "");
        $sheet->mergeCells('A1:L1');
        $sheet->mergeCells('A2:L2');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(15);
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(15);

        // buat header tabelnya
        $sheet->setCellValue('A4', "No");
        $sheet->setCellValue('B4', "Nomor SPM");
        $sheet->setCellValue('C4', "Tanggal SP2D");
        $sheet->setCellValue('D4', "Nomor SP2D");
        $sheet->setCellValue('E4', "Nilai SP2D");
        $sheet->setCellValue('F4', "Rek. Belanja");
        $sheet->setCellValue('G4', "Akun Pajak");
        $sheet->setCellValue('H4', "Jenis Pajak");
        $sheet->setCellValue('I4', "Nilai Pajak");
        $sheet->setCellValue('J4', "E-Biling");
        $sheet->setCellValue('K4', "NTPN");
        $sheet->setCellValue('L4', "Ket");
        $sheet->setCellValue('M4', "Bulan");

        $sheet->getStyle('A4')->applyFromArray($style_col);
        $sheet->getStyle('B4')->applyFromArray($style_col);
        $sheet->getStyle('C4')->applyFromArray($style_col);
        $sheet->getStyle('D4')->applyFromArray($style_col);
        $sheet->getStyle('E4')->applyFromArray($style_col);
        $sheet->getStyle('F4')->applyFromArray($style_col);
        $sheet->getStyle('G4')->applyFromArray($style_col);
        $sheet->getStyle('H4')->applyFromArray($style_col);
        $sheet->getStyle('I4')->applyFromArray($style_col);
        $sheet->getStyle('J4')->applyFromArray($style_col);
        $sheet->getStyle('K4')->applyFromArray($style_col);
        $sheet->getStyle('L4')->applyFromArray($style_col);
        $sheet->getStyle('M4')->applyFromArray($style_col);

        $data_office = DB::table('pajakkpp')
                    ->select('pajakkpp.ebilling', 'sp2d.tanggal_sp2d', 'pajakkpp.nilai_pajak', 'sp2d.nomor_sp2d', 'sp2d.nomor_spm', 'sp2d.tanggal_spm', 'pajakkpp.nomor_npwp', 'pajakkpp.akun_pajak', 'pajakkpp.ntpn', 'pajakkpp.jenis_pajak', 'potongan2.nilai_pajak','pajakkpp.rek_belanja','pajakkpp.nama_npwp', 'pajakkpp.id_potonganls', 'pajakkpp.id', 'potongan2.status1', 'pajakkpp.status2', 'pajakkpp.created_at', 'pajakkpp.bukti_pemby', 'sp2d.nilai_sp2d', 'pajakkpp.nilai_pajak', 'potongan2.id_pajakkpp','sp2d.nama_skpd','pajakkpp.rek_belanja', 'pajakkpp.periode')
                    // ->join('tb_akun_pajak', 'tb_akun_pajak.id', '=', 'pajakkpp.akun_pajak')
                    // ->join('tb_jenis_pajak', 'tb_jenis_pajak.id', '=', 'pajakkpp.jenis_pajak')
                    ->join('potongan2',  'potongan2.id', 'pajakkpp.id_potonganls')
                    ->join('sp2d', 'sp2d.idhalaman', 'potongan2.id_potongan')
                    // ->where('pajakkpp.status2', ['Terima'])
                    // ->whereBetween('sp2d.tanggal_sp2d', ['2024-01-01', '2024-12-31'])
                    ->get();
        
        $no = 1;
        $numrow = 5;

        foreach($data_office as $data){
            $sheet->setCellValue('A'.$numrow, $no++);
            $sheet->setCellValue('B'.$numrow, $data->nomor_spm);
            $sheet->setCellValue('C'.$numrow, date('d/m/y', strtotime($data->tanggal_sp2d)));
            $sheet->setCellValue('D'.$numrow, $data->nomor_sp2d);
            $sheet->setCellValue('E'.$numrow, $data->nilai_sp2d);
            $sheet->setCellValue('F'.$numrow, $data->rek_belanja);
            $sheet->setCellValue('G'.$numrow, $data->akun_pajak);
            $sheet->setCellValue('H'.$numrow, $data->jenis_pajak);
            $sheet->setCellValue('I'.$numrow, $data->nilai_pajak);
            $sheet->setCellValue('J'.$numrow, $data->ebilling);
            $sheet->setCellValue('K'.$numrow, $data->ntpn);
            $sheet->setCellValue('L'.$numrow, $data->nama_skpd);
            $sheet->setCellValue('M'.$numrow, $data->periode);

            // Apply style row yang telah kita buat tadi di masing" baris
            $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('K'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('L'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('M'.$numrow)->applyFromArray($style_row);

            $numrow++;
        }

        // set witdh kolom
        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(50);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(50);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(12);
        $sheet->getColumnDimension('H')->setWidth(25);
        $sheet->getColumnDimension('I')->setWidth(25);
        $sheet->getColumnDimension('J')->setWidth(25);
        $sheet->getColumnDimension('K')->setWidth(25);
        $sheet->getColumnDimension('L')->setWidth(60);
        $sheet->getColumnDimension('M')->setWidth(12);


        // set kolom menjadi auto
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // set kertas menjadi landscape
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

    }
}
