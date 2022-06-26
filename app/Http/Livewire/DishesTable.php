<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;

class DishesTable extends Component
{

    public $items;

    public $category;

    public $dishes;

    public $dish_categories;

    public $current_category = 1;


    public function mount ()
    {
        $this->current_category = 1;


        $this->dishes = Item::all();
        $this->dish_categories = Category::all();
        $this->getItemsAndCategory($this->current_category);
    }

    public function getItemsAndCategory($cid)
    {
        $this->items = Item::where('category_id', $cid)->get();
        $this->category = Category::find($cid);
    }

    public function setCategory($cid)
    {
        if (isset($cid))
        {
            $this->current_category = $cid;
            $this->getItemsAndCategory($cid);
        }
    }

    public function render()
    {
        return view('livewire.dishes-table');
    }
}
