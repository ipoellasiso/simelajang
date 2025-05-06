<?php

namespace App\Exports;

Use App\Models\PajaklsModel;
Use App\Models\PotonganModel;
Use App\Models\BelanjalsguModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataExportSpmgu implements FromView, ShouldAutoSize, WithEvents
{
    protected $datapajakguspm;
    protected $bulanspm;


    public function __construct($datapajakguspm, $bulanspm)
    {
        $this->datapajakguspm = $datapajakguspm;
        $this->bulanspm = $bulanspm;
    }

    public function view(): View
    {
        return view('Laporan_GU_SPM_admin.Laporan_Rekap.Viewisilaporanguspm', ['datapajakguspm' => $this->datapajakguspm, 'bulanspm' => $this->bulanspm]);
    }

    // public function headings(): array
    // {
    //     return [
    //         'No',
    //         'Nomor SPM',
    //         'Tanggal SP2D',
    //         'Nomor SP2D',
    //         'Nilai SP2D',
    //         'Rek. Belanja',
    //         'Akun Pajak',
    //         'Jenis Pajak',
    //         'Nilai Pajak',
    //         'E-Biling',
    //         'NTPN',
    //         'Ket',
    //         'Bulan',
    //     ];
    // }
    
    // public function array(): array
    // {
    //     return $this->data->toArray();
    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(false);
            },
        ];
    }
}
