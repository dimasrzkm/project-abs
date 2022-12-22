<?php

namespace App\Http\Livewire\Products;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $products = [], $editedProductIndex = null, $editedProductId = null, $deletedProductIndex = null;
    public $nameProduct, $price, $stock, $idCategorie, $actionForm = "tambah";

    // props categories
    public $categories;
    // props untuk stocks
    public $recipes, $recipeStocks = [];

    //datables
    public $sortByField = 'name_product';
    public $sortDirection = 'asc';
    public $search = '';
    public $showPerPage = 5;

    //listener
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->addNewRecipe();
    }

    public function resetAttributes()
    {
        $this->nameProduct = '';
        $this->price = '';
        $this->stock = '';
        $this->idCategorie = null;
        $this->actionForm = "tambah";
        $sumOfRecipes = count($this->recipeStocks);
        if ($sumOfRecipes<= 1) {
            array_pop($this->recipeStocks);
            $this->addNewRecipe();
        } else if ($sumOfRecipes > 1 && !is_null($this->recipeStocks)) {
            for ($i=0; $i <= $sumOfRecipes; $i++) { 
                array_pop($this->recipeStocks);
            }
            $this->addNewRecipe();
        } else {
            for ($i=0; $i < $sumOfRecipes - 1; $i++) { 
                array_pop($this->recipeStocks);
            }
        }
    }

    public function addNewRecipe()
    {
        $this->recipeStocks[] = [];
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

    public function store()
    {
        $this->validate([
            'nameProduct' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'recipeStocks.*.stock_id' => 'required',
            'recipeStocks.*.amount' => 'required',
        ]);
        $product = Product::Create([
            'name_product' => $this->nameProduct,
            'price' => $this->price,
            'stock' => $this->stock,
            'categorie_id' => $this->idCategorie,
        ]);
        for ($i=0; $i < count($this->recipeStocks); $i++) { 
            $product->stocks()->attach([$this->recipeStocks[$i]['stock_id'] => ['total' => $this->recipeStocks[$i]['amount']] ]);
            Stock::find($this->recipeStocks[$i]['stock_id'])->decrement('amount', $this->stock * $this->recipeStocks[$i]['amount']);
        }
        $this->emit('refreshComponent');
        $this->resetAttributes();
    }

    // action cancel
    public function actionCancel($action)
    {
        (strtolower($action) == 'edit') ? $this->editedProductIndex = null : $this->deletedProductIndex = null;
    }

    public function actionModal($action, ...$params)
    {
        $this->actionForm = strtolower($action);
        if ($this->actionForm == 'edit') {
            $this->editedProductId = $params[0]; //idProduct
            $productEdit = Product::find($this->editedProductId);
            $this->nameProduct = $productEdit->name_product;
            $this->price = $productEdit->price;
            $this->stock = $productEdit->stock;
            $this->idCategorie = $productEdit->categorie_id;

            $this->recipeStocks = null;
            foreach ($productEdit->stocks as $data) {
                $this->recipeStocks[] = ["stock_id" => $data->id, 'amount' => $data->pivot->total];
            }
        } else {
            $this->deletedProductIndex = $params[0];
        }
    }

    public function updateProduct()
    {
        $product = [
            'name_product' => $this->nameProduct,
            'price' => $this->price,
            'stock' => $this->stock,
            'categorie_id' => $this->idCategorie,
        ];
        if(!is_null($product)) {
            $editedProduct = Product::find($this->editedProductId);
            $oldTotalIngredients = count($editedProduct->stocks); 
            $oldStock = $editedProduct->stock;
            if($editedProduct) {
                $editedProduct->update($product);
            }
            if ((int) $this->stock != $oldStock) { // kondisi dimana stock mengalami perubahan
                for ($i=0; $i < count($this->recipeStocks); $i++) { 
                    $editedProduct->stocks()->syncWithoutDetaching([$this->recipeStocks[$i]['stock_id'] => ['total' => $this->recipeStocks[$i]['amount']] ]);
                    Stock::find($this->recipeStocks[$i]['stock_id'])->decrement('amount', ((int) $this->stock - $oldStock) * $this->recipeStocks[$i]['amount']);
                }
            } else if (count($this->recipeStocks) != $oldTotalIngredients) {  // kondisi dimana perubahan ada pada recipes
                for ($i=0; $i < count($this->recipeStocks); $i++) { 
                    $editedProduct->stocks()->syncWithoutDetaching([$this->recipeStocks[$i]['stock_id'] => ['total' => $this->recipeStocks[$i]['amount']] ]);
                    Stock::find($this->recipeStocks[$i]['stock_id'])->decrement('amount', ((int) $this->stock - $oldStock) * $this->recipeStocks[$i]['amount']);
                }
            } else { // kondisi dimana stock tidak mengalami perubahan, tetapi pada ingredients terdapat perubahan amount
                for ($i=0; $i < count($this->recipeStocks); $i++) { 
                    // masukan data amount yang diedit yang akan berubah !!!!!!
                    $editedProduct->stocks()->syncWithoutDetaching([$this->recipeStocks[$i]['stock_id'] => ['total' => $this->recipeStocks[$i]['amount']] ]);
                    Stock::find($this->recipeStocks[$i]['stock_id'])->decrement('amount', $this->stock * $this->recipeStocks[$i]['amount']);
                }
            }
            $this->resetAttributes();
        }
    }

    public function deleteProduct()
    {
        $product = $this->products[$this->deletedProductIndex] ?? null;
        if (!is_null($product)) {
            $deletedProduct = Product::find($product['id']);
            ($deletedProduct) ? $deletedProduct->delete() : "Tidak ada product";
        }
    }

    public function render()
    {
        // search
        $this->products = Product::with('categorie')
                                ->search($this->search)
                                ->orderBy($this->sortByField, $this->sortDirection)
                                ->paginate($this->showPerPage);
        $links = $this->products;
        $this->products = collect($this->products->items());
        $this->categories = Categorie::all();
        $this->recipes = Stock::all();
        return view('livewire.products.index', [
            'products' => $this->products,
            'categories' => $this->categories,
            'links' => $links,
        ]);
    }
}
