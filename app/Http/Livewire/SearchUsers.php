<?php


namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchUsers extends Component
{
    public string $search = '';

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = (string) request()->query('search', $this->search);
    }
    public function render()
    {
        if(!empty($this->search)) {
            return view('discover', [
                'users' => User::where('first_name', 'LIKE','%'.$this->search.'%')->paginate(8),
            ])->render();
        }
        return view('livewire.search-users', ['users' => []]);
    }
}
