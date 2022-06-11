<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReport;
use Illuminate\Http\Request;



class EdashboardController extends Controller
{
    public function index()
    {
        return view('edashboard.index');
    }

    public function orders_today()
    {
        return view('edashboard.order.orders_today');
    }

    public function orders_all()
    {
        $orders = Order::all();
        return view('edashboard.order.orders_all', [
            'orders' => $orders
        ]);
    }

    public function edit_order(Order $order, Item $item, OrderItem $orderItem, Category $category)
    {
        return view('edashboard.order.edit_order', [
            'order' => $order,
            'order_items' => OrderItem::where('order_id', $order->id)->get(),
            'category' => $category
        ]);
    }

    public function edit_report(OrderReport $report, Order $order)
    {
        return view('edashboard.report.edit_report', [
            'report' => $report,
        ]);
    }

    public function reports()
    {
        return view('edashboard.report.reports');
    }
}
