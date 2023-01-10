<?php

namespace App\Http\Livewire\Pembukuan;

use App\Exports\PembukuanExport;
use App\Models\Pembukuan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, AuthorizesRequests;

    public $pembukuan = [];

    public $actionForm = 'tambah';

    public $tanggalPembukuan;

    public $jumlahProduct;

    public $nominalMasuk;

    public $nominalKeluar;

    public $keterangan;

    public $idPembukuan;

    //datables
    public $sortByField = 'tanggal';

    public $sortDirection = 'desc';

    public $search = '';

    public $showPerPage = 5;

    // filter date for export start to end
    public $startDateFilter;

    public $endDateFilter;

    // function datatable
    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortDirection == 'asc') ? 'desc' : 'asc';
        $this->sortByField = $field;
    }

    public function showPage($page)
    {
        $this->showPerPage = $page;
    }
    // end function datatable

     //listener
     protected $listeners = ['refreshComponent' => '$refresh'];

    public function resetAttributes()
    {
        $this->jumlahProduct = null;
        $this->nominalMasuk = null;
        $this->nominalKeluar = null;
        $this->keterangan = null;
        $this->tanggalPembukuan = null;
        $this->actionForm = 'tambah';
    }

    public function actionCancel($action)
    {
        (strtolower($action) == 'edit') ? $this->idPembukuan = null : $this->idPembukuan = null;
    }

    public function actionModal($action, ...$params)
    {
        $this->actionForm = strtolower($action);
        if ($this->actionForm == 'edit') {
            $pembukuanEdit = Pembukuan::find($params[0]);
            $this->jumlahProduct = $pembukuanEdit->jumlah;
            $this->nominalKeluar = $pembukuanEdit->nominal_keluar;
            $this->nominalMasuk = $pembukuanEdit->nominal_masuk;
            $this->keterangan = $pembukuanEdit->keterangan;
            $this->tanggalPembukuan = $pembukuanEdit->tanggal->format('Y-m-d');
            $this->idPembukuan = $pembukuanEdit->id;
        } else {
            $this->idPembukuan = $params[0];
        }
    }

    public function updatePembukuan()
    {
        $dataEditPembukuan = Pembukuan::findOrFail($this->idPembukuan);
        $attributes = [
            'jumlah' => $this->jumlahProduct,
            'nominal_masuk' => $this->nominalMasuk != '' ? $this->nominalMasuk : 0,
            'nominal_keluar' => $this->nominalKeluar != '' ? $this->nominalKeluar : 0,
            'keterangan' => $this->keterangan,
            'tanggal' => $this->tanggalPembukuan,
        ];
        if ($attributes['nominal_keluar'] == 0 && $attributes['nominal_masuk'] > 0) {
            $dataEditPembukuan->update($attributes);
        } else {
            $dataEditPembukuan->update($attributes);
        }
    }

    public function deletePembukuan()
    {
        $deleteDataPembukuan = Pembukuan::findOrFail($this->idPembukuan);
        ($deleteDataPembukuan) ? $deleteDataPembukuan->delete() : 'Tidak ada Data Pembukuan';
    }

    public function store()
    {
        Pembukuan::Create([
            'jumlah' => $this->jumlahProduct,
            'nominal_masuk' => $this->nominalMasuk ?? 0,
            'nominal_keluar' => $this->nominalKeluar ?? 0,
            'keterangan' => $this->keterangan,
            'tanggal' => $this->tanggalPembukuan,
        ]);
        $this->emit('refreshComponent');
        $this->resetAttributes();
    }

    public function export()
    {
        // dd($this->startDateFilter, $this->endDateFilter);
        if ($this->startDateFilter != null && $this->endDateFilter != null) {
            return Excel::download(new PembukuanExport($this->startDateFilter, $this->endDateFilter), 'pembukuan.xlsx');
        } else {
            dd('jalan 2');
        }
    }

    public function render()
    {
        $this->authorize('isAdmin');
        // search
        $this->pembukuan = Pembukuan::search($this->search)->orderBy($this->sortByField, $this->sortDirection)->paginate($this->showPerPage);
        $links = $this->pembukuan;
        $this->pembukuan = collect($this->pembukuan->items());

        return view('livewire.pembukuan.index', [
            'pembukuan' => $this->pembukuan,
            'links' => $links,
        ]);
    }
}
