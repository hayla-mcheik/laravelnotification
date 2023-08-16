<?php

namespace App\Http\Livewire\Admin\Category;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Component;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;

public function deleteCategory($category_id)
{
$this->category_id= $category_id;
}

public function destroyCategory()
{

    $category = Category::find($this->category_id);

    $category->delete();
    $this->dispatchBrowserEvent('close-modal');
}


    public function render()
    {
        $categories = Category::OrderBy('id','DESC')->paginate(10);
        return view('livewire.admin.category.index',['categories'=> $categories]);
    }
}
