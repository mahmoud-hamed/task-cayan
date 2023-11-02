<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeSearch extends Component
{
    public $search = '';
    use WithPagination;

protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = User::where('first_name', 'LIKE', '%' . $this->search . '%')->paginate(10);

        return view('livewire.employee-search' , ['data'=>$data]);
    }
}
