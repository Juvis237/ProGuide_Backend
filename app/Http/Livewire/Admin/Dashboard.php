<?php

namespace App\Http\Livewire\Admin;

use App\Models\Blog;
use App\Models\FAQ;
use App\Models\Request;
use App\Models\Skill;
use App\Models\testimonial;
use App\Models\User;
use App\Models\Page;
use App\Models\Payment;
use App\Models\UserService;
use Livewire\Component;

class Dashboard extends Component
{

    public $blogCount;
    public $testimonialCount;
    public $faqCount;
    public $adminUserCount;
    public $UserCount;
    public $agentCount;
    public $paymentCount;
    public $revenueCount;

    public $requestCount;
    public $businessCount;
    public $businessCategoryCount;
    public $businesServiceCount;
    public $pageCount;

    public function mount()
    {
        $this->blogCount = Blog::count();
        $this->testimonialCount = testimonial::count();
        $this->faqCount = FAQ::count();
        $this->adminUserCount = User::where('role', 'admin')->count();
        $this->UserCount = User::where('role', 'normal')->count();
        $this->requestCount = Request::count();
        $this->businessCount = User::where('role', 'worker')->count();
        $this->pageCount = Page::count();
        $this->agentCount = User::where('role', 'agent')->count();
        $this->paymentCount = Payment::where('status', 'successful')->count();
        $this->revenueCount = Payment::where('status', 'successful')->sum('amount');
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}