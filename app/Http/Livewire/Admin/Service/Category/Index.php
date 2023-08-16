<?php

namespace App\Http\Livewire\Admin\Service\Category;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\CategoryService;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $categoryservice =CategoryService::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.service.category.index',['categoryservice' => $categoryservice]);
    }
}
