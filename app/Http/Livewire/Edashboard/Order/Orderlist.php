<?php

namespace App\Http\Livewire\Edashboard\Order;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Livewire\Component;

class Orderlist extends Component
{
    public $orders;



    public function mount(Order $orders, OrderItem $item)
    {
        $this->orders = Order::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.edashboard.order.orderlist');
    }
}
