<?php

namespace App\Exports;

use App\Models\Pembukuan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PembukuanExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $pembukuan;

    public function __construct(string $startDate, string $endDate)
    {
        // dd($startDate, $endDate);
        $test = Pembukuan::whereBetween('tanggal', ["$startDate", "$endDate"])->orderBy('tanggal', 'asc')->get();
        $this->pembukuan = $test;
    }

    public function view(): View
    {
        return view('excel.pembukuan', [
            'pembukuan' => $this->pembukuan,
        ]);
    }
}
