<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReport;
use App\Models\User;


class OrderController extends Controller
{
    public function index(Order $order)
    {
        return view('order.index', [
            'orders' => Order::orderBy('created_at', 'desc')->simplePaginate(6)
        ]);
    }
    public function create()
    {
        return view('order.create');
    }
    public function show(Order $order, Address $address, OrderItem $orderItem, Item $item, Category $category)
    {
        return view('order.show', [
            'order' => $order,
            'order_items' => OrderItem::where('order_id', $order->id)->get()
        ]);
    }

    public function delete(Order $order)
    {
        if ($order->exists)
        {
            $order->delete();
            session()->flash('message', 'Pomyślnie usunięto zamówienie ID ' . $order->id . '.');
        }
        else
        {
            session()->flash('message', 'Nie znaleziono takiego zamówienia w bazie danych.');
        }
        return redirect(route('edashboard.orders'));
    }

}
