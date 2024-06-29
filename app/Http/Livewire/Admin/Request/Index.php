<?php

namespace App\Http\Livewire\Admin\Request;

use App\Http\Livewire\DataTable\DataTable;
use App\Models\Request;
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
        return Request::query()->select('requests.*');
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

        return $query->where('name', 'like', "%$value%");
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
