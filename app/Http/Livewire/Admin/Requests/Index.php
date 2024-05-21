<?php

namespace App\Http\Livewire\Admin\Requests;

use App\Models\Cities;
use App\Models\Regions;
use App\Models\Skill;
use App\Models\User;
use Livewire\Component;
use App\Http\Livewire\DataTable\DataTable;
use Illuminate\Http\Request;

class Index extends Component
{
    use DataTable;
    protected $listeners = [
    ];

    public User $user;
    public Request $request;

    public $categories = [];
    public $sub_categories = [];
    public $regions = [];
    public $cities = [];
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
        $this->regions = Regions::all();
    }


    protected function getBaseQuery()
    {
        return \App\Models\Request::query()->select('requests.*')->whereNot('status', 'draft');

    }

    public function resetFilters()
    {
        $this->filters = [
            "name" => '',
            "category" => '',
            "sub_category" => '',
            "region" => '',
            "city" => ''
        ];
    }

    public function render()
    {
        return view('livewire.admin.requests.index', ['requests' => $this->rows]);
    }

    public function filterName($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->where(function ($q) use ($value){
            $q->orWhere('title','like',"%$value%")->orWhere('description','like',"%$value%")->orWhere('skills','like',"%$value%");
        });
    }

    public function filterRegion($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->where('region_id',$value);
    }

    public function filterCity($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->where('city_id', $value);
    }

    public function filterCategory($query, $value)
    {
        $main = $this->filters['category'];
        $sub = $this->filters['sub_category'];

        if (strlen($value) === 0) {
            return $query;
        }

        return $query->whereHas('service', function ($q) use ($main, $sub){
            return $q->whereHas('userServiceSkill', function ($qq) use ($main, $sub){
                return $qq->whereIn('skill_id', [$main, $sub]);
            });
        });

    }

    public function filterSubCategory($query, $value)
    {
        $main = $this->filters['category'];
        $sub = $this->filters['sub_category'];

        if (strlen($value) === 0) {
            return $query;
        }

        return $query->whereHas('service', function ($q) use ($main, $sub){
            return $q->whereHas('userServiceSkill', function ($qq) use ($main, $sub){
                return $qq->whereIn('skill_id', [$main, $sub]);
            });
        });

    }

    public function updated($key)
    {
        if($key == "filters.region"){
            $query = $this->getBaseQuery();
            $this->applyFilters($query);
            $this->cities = [];
            $this->filters['city'] = "";
        }

        if($key == "filters.category"){
            $query = $this->getBaseQuery();
            $this->applyFilters($query);
        }
    }

    public function set_cities(){
        $this->cities = Cities::where('region_id', $this->filters['region'])->get();;
    }
}
