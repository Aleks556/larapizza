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

    //public $sorted_dishes = [];

    public function mount ()
    {
        $this->current_category = 1;


        $this->dishes = Item::all();
        $this->dish_categories = Category::all();
        $this->getItemsAndCategory($this->current_category);

//        foreach ($this->dish_categories as $category)
//        {
//            $dishes = Item::where('category_id', $category->id)->get();
//            array_push($this->sorted_dishes, ['category_id' => $category->id, 'dishes' => $dishes ]);
//        }

        //dd($this->sorted_dishes);
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
            //$this->dishes = Item::where('category_id', $this->current_category)->get();
        }
    }

    public function render()
    {
        return view('livewire.dishes-table');
    }
}
