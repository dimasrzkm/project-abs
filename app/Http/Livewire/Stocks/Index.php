<?php

namespace App\Http\Livewire\Stocks;

use App\Models\Stock;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $stocks, $editedStockIndex = null, $deletedStockIndex = null;
    public $storeStocks = [];

    // datables
    public $sortByField = 'name_stock';
    public $sortDirection = 'asc';
    public $search = '';
    public $showPerPage = 5;

    //listener
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->addNewStock();
    }

    public function addNewStock()
    {
        $this->storeStocks[] = [];
    }

    public function resetNewStock()
    {
        $sumOfStocks = count($this->storeStocks);
        if ($sumOfStocks<= 1) {
            array_pop($this->storeStocks);
            $this->addNewStock();
        } else if ($sumOfStocks > 1 && !is_null($this->storeStocks)) {
            for ($i=0; $i <= $sumOfStocks; $i++) { 
                array_pop($this->storeStocks);
            }
            $this->addNewStock();
        } else {
            for ($i=0; $i < $sumOfStocks - 1; $i++) { 
                array_pop($this->storeStocks);
            }
        }
    }

    public function actionCancel($action)
    {
        (strtolower($action) == 'edit') ? $this->editedStockIndex = null : $this->deletedStockIndex = null;
    }

    public function getIdStock($action, $idStock)
    {
        (strtolower($action) == 'edit') ? $this->editedStockIndex = $idStock : $this->deletedStockIndex = $idStock;
    }

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

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function actionModal($action)
    {
        $stock = $this->stocks[($action == 'edit') ? $this->editedStockIndex : $this->deletedStockIndex] ?? null;
        if (!is_null($stock)) {
            $editedStock = Stock::find($stock['id']);
            if($editedStock) {
                if (strtolower($action) == 'edit') {
                    $stock['amount'] = $stock['quantity'] * 1000;
                    $editedStock->update($stock);
                    $this->editedStockIndex = null;
                } else {
                    $editedStock->delete();
                    $this->deletedStockIndex = null;
                }
            }
        }
    }

    protected $rules = [
        'storeStocks.*.name_stock' => ['required'],
        'storeStocks.*.quantity' => ['required', 'numeric'],
        'storeStocks.*.price' => ['required', 'numeric'],
    ];

    protected $validationAttributes = [
        'storeStocks.*.name_stock' => 'name',
        'storeStocks.*.quantity' => 'quantity',
        'storeStocks.*.price' => 'price',
    ];

    public function store()
    {
        $this->validate();
        for ($i=0; $i < count($this->storeStocks); $i++) {
            Stock::Create([
                'user_id' => Auth::user()->id,
                'name_stock' => $this->storeStocks[$i]['name_stock'],
                'amount' => $this->storeStocks[$i]['quantity'] * 1000,
                'quantity' => $this->storeStocks[$i]['quantity'],
                'price' => $this->storeStocks[$i]['price'],
                'date_buy' => Carbon::now()->format('Y/m/d')
            ]);
        }
        $this->emit('refreshComponent');
        $this->resetNewStock();
    }

    public function render()
    {
         // search
         $this->stocks = Stock::with('user')->search($this->search)->orderBy($this->sortByField, $this->sortDirection)->paginate($this->showPerPage);
         $links = $this->stocks;
         $this->stocks = collect($this->stocks->items());
        return view('livewire.stocks.index', [
            'stocks' => $this->stocks,
            'links' => $links,
        ]);
    }
}
