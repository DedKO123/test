<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $per_page = 6;

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::query()->latest()->paginate($this->per_page),
        ]);
    }

    public function load()
    {
        $this->per_page +=6;
    }
}
