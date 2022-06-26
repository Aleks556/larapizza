<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(OrderReport $orderReport, Order $order)
    {
        $report_count = OrderReport::where('order_id', $order->id)->count();
        $available = 0;
        $report = null;
        if ($report_count == 0)
        {
            $available = 1;
        }
        else
        {
            $report = OrderReport::where('order_id', $order->id)->get();
        }
        return view('order.report', [
            'order' => $order,
            'available' => $available,
            'report' => $report,
        ]);

    }

    public function storeReport(Order $order)
    {
        $attributes = request()->validate([
            'problem' => 'required',
            'description' => 'max:300',
        ]);
        $attributes['user_id'] = request()->user()->id;
        $attributes['order_id'] = request()->order->id;
        OrderReport::create($attributes);

        return redirect()->to(route('orders'))->with('message', 'Adres został pomyślnie dodany do konta.');
    }
}
