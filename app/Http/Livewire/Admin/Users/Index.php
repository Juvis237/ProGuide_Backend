<?php

namespace App\Http\Livewire\Admin\Users;

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
        'userCreated'=>'$refresh',
        'userDeleted'=>'$refresh',
    ];

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
        $this->regions = Regions::all();
        $this->perPage = 15;
        $this->page = 1;
    }

    protected function getBaseQuery()
    {
        return User::query()->select('users.*')->where('role', 'client')->where('admin', 0);
    }

    public function resetFilters()
    {
        $this->filters = [
            "name" => '',
            "region" => '',
            "city" => ''
        ];
    }

    public function filterName($query, $value)
    {
        if (strlen($value) === 0) {
            return $query;
        }

        return $query->where(function ($q) use ($value){
            $q->orWhere('first_name','like',"%$value%")->orWhere('last_name','like',"%$value%")->orWhere('bio','like',"%$value%");
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

    public function set_sub(){
        $this->sub_categories = Skill::where('skill_id',$this->filters['category'])->get();
    }

    public function set_cities(){
        $this->cities = Cities::where('region_id', $this->filters['region'])->get();;
    }

    public function render()
    {
        return view('livewire.admin.users.index', ['users'=>$this->rows]);
    }
}
