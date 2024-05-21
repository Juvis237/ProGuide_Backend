<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Http\Livewire\DataTable\DataTable;
use App\Models\Page;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{

    use DataTable;
    public function render()
    {
        return view('livewire.admin.pages.index', ['pages' => $this->rows]);
    }

    protected $listeners = [
        'pageUpdated' => '$refresh'
    ];


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


    public function mount(Request $request)
    {
        $this->resetFilters();
        $this->resetSort();
        $this->perPage = 15;
        $this->page = 1;
    }

    protected function getBaseQuery()
    {
        return Page::query()->select('pages.*');
    }

    public function resetFilters()
    {
        $this->filters = ["name" => ''];
    }

    public function filterName($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->where('title', 'like', "%{$value}%")
            ->orWhere('content', 'like', "%{$value}%");
    }
}
