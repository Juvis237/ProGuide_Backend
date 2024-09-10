<?php

namespace App\Http\Livewire\Admin\Request;

use App\Http\Livewire\DataTable\DataTable;
use App\Models\Request;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    use DataTable;


    protected $listeners = [
        'Created'=>'$refresh',
        'Deleted'=>'$refresh',
    ];


    protected function getBaseQuery()
    {
        return Request::query()->select('requests.*')->where('paid', 1);
    }

    public function resetFilters()
    {
        $this->filters = ["name"=>''];
    }

    /**
     * Configure sort when loading the page or switching the tab group
     *
     * @return void
     */
    private function resetSort()
    {
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
    }


    public function mount(Request $request){
        $this->resetFilters();
        $this->resetSort();
        $this->perPage = 15;
        $this->page = 1;
    }


    public function filterName($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->whereIn('user_id', function ($value){
            return User::where('first_name' , 'like' , "%$value%")->orWhere('last_name' , 'like' , "%$value%")->pluck('id');
        });
    }
    public function filterStatus($query, $value){
        if (strlen($value) === 0) {
            return $query;
        }
        return $query->where('status', $value);
    }
    public function render()
    {
        return view('livewire.admin.request.index',['requests'=>$this->rows]);
    }
}
