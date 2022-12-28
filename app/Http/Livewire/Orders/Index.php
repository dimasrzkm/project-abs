<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Receipt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $tanggalTransaksi;

    public $products;

    public $actionForm = 'tambah';

    public $productStore = [];

    public $editedOrderId = null;

    public $deletedOrderId = null;

    public $total = null;

    public $subTotal = null;

    public $tax = 2000;

    public $qrUrl = null;

    //datables
    public $sortByField = 'id';

    public $sortDirection = 'desc';

    public $search = '';

    public $showPerPage = 5;

    //listener
    protected $listeners = ['refreshComponent' => '$refresh'];

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

    public function mount()
    {
        $this->products = Product::all();
    }

    public function resetAttributes()
    {
        $this->tanggalTransaksi = null;
        $this->total = null;
        $this->subTotal = null;
        $sumOfOrders = count($this->productStore);
        $this->actionForm = 'tambah';
        if ($sumOfOrders <= 1) {
            array_pop($this->productStore);
        } elseif ($sumOfOrders > 1 && ! is_null($this->productStore)) {
            for ($i = 0; $i <= $sumOfOrders; $i++) {
                array_pop($this->productStore);
            }
        } else {
            for ($i = 0; $i < $sumOfOrders - 1; $i++) {
                array_pop($this->productStore);
            }
        }
    }

    public function actionCancel($action)
    {
        (strtolower($action) == 'edit') ? $this->editedOrderId = null : $this->deletedOrderId = null;
    }

    public function addNewItems()
    {
        if (empty($this->productStore)) {
            $this->productStore[] = [];
        } elseif (empty($this->productStore[count($this->productStore) - 1]['is_confirm']) && $this->actionForm == 'tambah') {
            dd('yes nih');
        } elseif (empty($this->productStore[count($this->productStore) - 1]['is_confirm']) && $this->actionForm == 'edit') {
            dd('yes');
        } else {
            $this->productStore[] = [];
        }
    }

    public function actionModal($action, ...$params)
    {
        $this->actionForm = strtolower($action);
        if ($this->actionForm == 'edit') {
            $this->editedOrderId = $params[0]; //idorder
            $orderEdit = Order::find($this->editedOrderId);
            $userId = $orderEdit->user_id;
            $this->tanggalTransaksi = date('Y-m-d', strtotime($orderEdit->date_order));

            $this->productStore = null;
            foreach ($orderEdit->products as $data) {
                $this->productStore[] = [
                    'product_id' => $data->id,
                    'amount' => $data->pivot->amount,
                    'name_product' => $data->name_product,
                    'is_confirm' => true,
                ];
            }
            $this->total = $orderEdit->total - $this->tax;
            $this->subTotal = $orderEdit->total;
        } elseif ($this->actionForm == 'generateqr') {
            $this->generateQr($params[0]);
        } elseif ($this->actionForm == 'generatepdf') {
            $this->generatePdf($params[0]);
        } else {
            $this->deletedOrderId = $params[0];
        }
    }

    public function generateQr($idOrder)
    {
        $this->qrUrl = Order::find($idOrder)->receipt->name_file;
    }

    public function confirmItem()
    {
        $idProduct = (int) $this->productStore[count($this->productStore) - 1]['product_id'];
        $collectionProducts = collect($this->products);
        $product = $collectionProducts->firstWhere('id', $idProduct);
        $this->total += $product->price * $this->productStore[count($this->productStore) - 1]['amount'];
        $this->subTotal = $this->total + $this->tax;
        $this->productStore[count($this->productStore) - 1]['name_product'] = $product->name_product;
        $this->productStore[count($this->productStore) - 1]['is_confirm'] = true;
    }

    public function deleteItem($itemIndex)
    {
        //menginialisasi variable bantuan untuk menyimpan data product dan total harga
        $productDelete = null;
        $totalPrice = null;
        $productIdWillEdited = empty($this->productStore[$itemIndex]['product_id']);
        $productAmount = empty($this->productStore[$itemIndex]['amount']);
        
        // memastikan bahwa product dan amount telah terisi 
        if ($productIdWillEdited || $productAmount) {
            $sumOfProductStore = count($this->productStore);
            // jika belum terisi maka item akan dihapus
            if ($sumOfProductStore == 1) {
                array_shift($this->productStore);
            } else if($sumOfProductStore >= 1) {
                array_splice($this->productStore, $itemIndex, 1);
            }
        } else if (($productIdWillEdited == false && $productAmount == false) && empty($this->productStore[$itemIndex]['is_confirm'])) {
            array_splice($this->productStore, $itemIndex, 1);
        } else { 
            // mengambil id untuk mencari product
            $valueIsSet = !empty($this->productStore[$itemIndex]) ? $this->productStore[$itemIndex]['product_id'] : null;
            if ($valueIsSet) {
                $productDelete = Product::findOrFail($this->productStore[$itemIndex]['product_id']) ?? null;
                $totalPrice = $productDelete->price * $this->productStore[$itemIndex]['amount'];
            }
            // dd('ss',$totalPrice);
            if ($itemIndex == 0 && count($this->productStore) == 1) {
                // dd('jalan 0');
                if ($valueIsSet) {
                    $this->total -= $totalPrice;
                    $this->subTotal -= ($totalPrice + $this->tax);
                }
                $this->tempAmount = $this->productStore[0]['amount'];
                $this->tempProductId = $this->productStore[0]['product_id'];
                array_shift($this->productStore);
            } elseif ($itemIndex == 0) {
                // dd('ini jalan 1');
                if ($valueIsSet) {
                    $this->total -= $totalPrice;
                    $this->subTotal = $this->total + $this->tax;
                }
                array_shift($this->productStore);
            } elseif ($itemIndex > 0 && $itemIndex < count($this->productStore) - 1) {
                // dd($itemIndex, count($this->productStore), 'ini jalan 2');
                if ($valueIsSet) {
                    $this->total -= $totalPrice;
                    $this->subTotal = $this->total + $this->tax;
                }
                array_splice($this->productStore, $itemIndex, 1);
            } else {
                // dd('ini jalan 3', count($this->productStore), $this->productStore);
                if ($valueIsSet) {
                    $this->total -= $totalPrice;
                    $this->subTotal = $this->total + $this->tax;
                }
                array_pop($this->productStore);
            }

        }
    }

    public function generatePdf($id)
    {
        $data = Order::with(['user', 'receipt'])->find($id);
        $pdf = Pdf::loadView('pdf.receipts', ['data' => $data])->setPaper('a4', 'portait');
        $nameFile = 'invoice-OD'.str_pad($data->id, 4, '0', STR_PAD_LEFT).'.pdf';
        Storage::put("public/pdf/$nameFile", $pdf->output());
        Receipt::create([
            'order_id' => $data->id,
            'name_file' => $nameFile,
            'url' => 'pdf/',
        ]);
    }

    
    protected $rules = [
        'tanggalTransaksi' => ['required', 'date'],
        'productStore.*.product_id' => ['required'],
        'productStore.*.amount' => ['required'],
    ];

    protected $validationAttributes = [
        'productStore.*.product_id' => 'product',
        'productStore.*.amount' => 'amount',
    ];


    public function store()
    {
        $this->validate();
        $ordersCreate = Order::create([
            'user_id' => Auth::user()->id,
            'status' => 'waiting',
            'total' => $this->subTotal,
            'date_order' => $this->tanggalTransaksi,
        ]);
        // 'name_tag' => $this->tags[$i]['tag']]
        for ($i = 0; $i < count($this->productStore); $i++) {
            $ordersCreate->products()->attach([
                $this->productStore[$i]['product_id'] => ['amount' => $this->productStore[$i]['amount']],
            ]);
        }

        $this->emit('refreshComponent');
        $this->resetAttributes();
    }

    public function changeStatus($id)
    {
        // dd($i);
        Order::find($id)->update(['status' => 'deliver']);
    }

    public function updateOrder()
    {
        $order = [
            'total' => $this->subTotal,
            'date_order' => $this->tanggalTransaksi,
        ];
        if (! is_null($order)) {
            $editedOrder = Order::find($this->editedOrderId);
            $editedOrder['status'] = 'waiting';
            if ($editedOrder) {
                $editedOrder->update($order);
            }
            // kondisi dimana penambahan item order
            if (count($this->productStore) > count($editedOrder->products)) {
                for ($i = 0; $i < count($this->productStore); $i++) {
                    $editedOrder->products()->syncWithoutDetaching([
                        $this->productStore[$i]['product_id'] => ['amount' => $this->productStore[$i]['amount']],
                    ]);
                }
            } elseif (count($this->productStore) == 0) {
                $editedOrder->products()->detach();
            } else { // kondisi dimana item order berkurang
                for ($i = 0; $i < count($this->productStore); $i++) {
                    $editedOrder->products()->sync([
                        $this->productStore[$i]['product_id'] => ['amount' => $this->productStore[$i]['amount']],
                    ]);
                }
            }
        }
    }

    public function deleteOrder()
    {
        if ($this->deletedOrderId) {
            $deletedOrder = Order::find($this->deletedOrderId);
            ($deletedOrder) ? $deletedOrder->delete() : 'Tidak ada Order';
            $this->resetAttributes();
        }
    }

    public function render()
    {
        // search
        $orders = Order::with('user')->search($this->search)->orderBy($this->sortByField, $this->sortDirection)->paginate($this->showPerPage);
        $links = $orders;
        $orders = collect($orders->items());

        return view('livewire.orders.index', [
            // 'orders' => Order::with('user')->get(),
            'orders' => $orders,
            'links' => $links,
        ]);
    }
}
