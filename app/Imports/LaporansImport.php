<?php

namespace App\Imports;

use App\Laporan;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class LaporansImport implements FromView,ShouldAutoSize
{
    use Exportable;

    public function view(): View {
        return view('export.export-laporan',[
            'laporan' => Laporan::all()
        ]);
    }
}
