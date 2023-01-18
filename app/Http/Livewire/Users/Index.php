<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, AuthorizesRequests;

    public $users = [];

    public $namaUser, $emailUser, $passwordUser, $roleUser;
    public $editedUserId = null;
    public $deletedUserid = null;

    public $actionForm = 'tambah';

    // datables
    public $sortByField = 'name';

    public $sortDirection = 'asc';

    public $search = '';

    public $showPerPage = 5;

    //listener
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortDirection == 'asc') ? 'desc' : 'asc';
        $this->sortByField = $field;
    }
    
    public function showPage($page)
    {
        $this->showPerPage = $page;
    }

    public function resetAttributes()
    {
        $this->namaUser = null;
        $this->emailUser = null;
        $this->passwordUser = null;
        $this->roleUser = null;
        $this->actionForm = 'tambah';
    }

    protected $rules = [
        'namaUser' => ['required', 'string', 'max:255'],
        'emailUser' => ['required', 'string', 'email', 'max:255'],
        'passwordUser' => ['required'],
    ];

    public function store()
    {
        $this->validate();
        User::create([
            'name' => $this->namaUser,
            'email' => $this->emailUser,
            'password' => bcrypt($this->passwordUser),
            'is_admin' => (int) $this->roleUser,
        ]);
        $this->emit('refreshComponent');
        $this->resetAttributes();
    }

    public function actionModal($action, ...$params)
    {
        $this->actionForm = strtolower($action);
        if ($this->actionForm == 'edit') {
            $this->editedUserId = $params[0]; //idProduct
            $userEdit = User::find($this->editedUserId);

            $this->namaUser = $userEdit->name;
            $this->emailUser = $userEdit->email;
            $this->roleUser = $userEdit->is_admin;
        } else {
            $this->deletedUserid = $params[0];
        }
    }

    // action cancel
    public function actionCancel($action)
    {
        (strtolower($action) == 'edit') ? $this->editedUserId = null : $this->deletedUserid = null;
    }

    public function updateUser()
    {
        $editedUser = User::find($this->editedUserId);
        $editedUser->update(['is_admin' => $this->roleUser]);
    }
    
    public function deleteUser()
    {
        $user = $this->users[$this->deletedUserid] ?? null;
        if (! is_null($user)) {
            $deletedUser = User::find($user['id']);
            ($deletedUser) ? $deletedUser->delete() : 'Tidak ada User';
        }
    }

    public function render()
    {
        $this->authorize('isAdmin');

        // $this->categories = Categorie::search($this->search)->orderBy($this->sortByField, $this->sortDirection)->paginate($this->showPerPage);
        $this->users = User::search($this->search)->orderBy($this->sortByField, $this->sortDirection)->paginate($this->showPerPage);
        $links = $this->users;
        $this->users = collect($this->users->items());
        return view('livewire.users.index', [
            'users' => $this->users,
            'links' => $links,
        ]);
    }
}
