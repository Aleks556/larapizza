<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function dishes(Item $item)
    {
        return view('dishes', [
            'dishes' => $item->all()
        ]);
    }
}
