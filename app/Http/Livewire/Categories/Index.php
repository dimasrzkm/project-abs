<?php

namespace App\Http\Livewire\Categories;

use App\Models\Categorie;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    //store and view
    public $categories = [];

    public $editedCategorieIndex = null;

    public $deletedCategorieIndex = null;

    public $nameCategorie;

    //datables
    public $sortByField = 'categorie';

    public $sortDirection = 'asc';

    public $search = '';

    public $showPerPage = 5;

    //listener
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function resetAttributes()
    {
        $this->nameCategorie = '';
        $this->resetErrorBag();
    }

    // for cancel edit action
    public function actionCancel($action)
    {
        (strtolower($action) == 'edit') ? $this->editedCategorieIndex = null : $this->deletedCategorieIndex = null;
    }

    // for get id Categorie
    public function getIdCategorie($action, $idCategorie)
    {
        (strtolower($action) == 'edit') ? $this->editedCategorieIndex = $idCategorie : $this->deletedCategorieIndex = $idCategorie;
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
        $categorie = $this->categories[($action == 'edit') ? $this->editedCategorieIndex : $this->deletedCategorieIndex] ?? null;
        if (! is_null($categorie)) {
            $editedCategorie = Categorie::find($categorie['id']);
            if ($editedCategorie) {
                if (strtolower($action) == 'edit') {
                    $categorie['slug'] = Str::slug($categorie['categorie']);
                    $editedCategorie->update($categorie);
                    $this->editedCategorieIndex = null;
                } else {
                    $editedCategorie->delete();
                    $this->deletedStockIndex = null;
                }
            }
        }
    }

    protected $rules = [
        'nameCategorie' => ['required', 'min:3'],
    ];

    public function store()
    {
        $this->validate();
        Categorie::create([
            'categorie' => $this->nameCategorie,
            'slug' => Str::slug($this->nameCategorie, '-'),
        ]);
        $this->emit('refreshComponent');
        $this->resetAttributes();
    }

    public function render()
    {
        // search
        $this->categories = Categorie::search($this->search)->orderBy($this->sortByField, $this->sortDirection)->paginate($this->showPerPage);
        $links = $this->categories;
        $this->categories = collect($this->categories->items());

        return view('livewire.categories.index', [
            'categories' => $this->categories,
            'links' => $links,
        ]);
    }
}
