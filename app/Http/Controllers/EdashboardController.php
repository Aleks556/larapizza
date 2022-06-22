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
        if (hasRole(auth()->user()->getUserEid(), 1))
        {
            return view('edashboard.index');
        }
        return redirect(route('welcome'));
    }

    public function orders_today()
    {
        if (hasRole(auth()->user()->getUserEid(), 1))
        {
            return view('edashboard.order.orders_today');
        }
        return redirect(route('welcome'));
    }

    public function orders_all()
    {
        if (hasRole(auth()->user()->getUserEid(), 1))
        {
            $orders = Order::all();
            return view('edashboard.order.orders_all', [
                'orders' => $orders
            ]);
        }
        return redirect(route('welcome'));
    }

    public function edit_order(Order $order, Item $item, OrderItem $orderItem, Category $category)
    {
        if (hasRole(auth()->user()->getUserEid(), 1))
        {
            return view('edashboard.order.edit_order', [
                'order' => $order,
                'order_items' => OrderItem::where('order_id', $order->id)->get(),
                'category' => $category
            ]);
        }
        return redirect(route('welcome'));
    }

    public function edit_report(OrderReport $report, Order $order)
    {
        if (hasRole(auth()->user()->getUserEid(), 2))
        {
            return view('edashboard.report.edit_report', [
                'report' => $report,
            ]);
        }
        return redirect(route('edashboard'));
    }

    public function reports()
    {
        if (hasRole(auth()->user()->getUserEid(), 1))
        {
            return view('edashboard.report.reports');
        }
        return redirect(route('welcome'));
    }
}
