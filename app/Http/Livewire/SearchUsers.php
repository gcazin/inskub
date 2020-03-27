<?php


namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class SearchUsers extends Component
{
    public string $search = '';

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.search-users', [
            'users' => User::where('name', 'LIKE','%'.$this->search.'%')->get(),
        ]);
    }
}
