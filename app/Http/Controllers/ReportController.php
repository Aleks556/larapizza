<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Order $order)
    {
        $report_count = OrderReport::where('order_id', $order->id)->count();
        $available = 0;
        $report = null;
        if ($report_count == 0)
        {
            $available = 1;
            $report_problem_name = '';
            return view('order.report', [
                'order' => $order,
                'available' => $available,
                'report' => $report,
//                'report_problem_name' => $report_problem_name
            ]);
        }
        else
        {
            $report = OrderReport::where('order_id', $order->id)->get();
            if (isset($report))
            {
                $report_problem_name = OrderReport::find($order->id)->getProblem();
            }
            return view('order.report', [
                'order' => $order,
                'available' => $available,
                'report' => $report,
                'report_problem_name' => $report_problem_name
            ]);
        }

    }

    public function storeReport(Order $order)
    {
        $attributes = request()->validate([
            //'problem' => 'required|in:edit,incomplete,badproducts,notarrived,badrest'
            'problem' => 'required',
            'description' => 'max:300',
        ]);
        //dd($attributes);
        $attributes['user_id'] = request()->user()->id;
        //dd(request());
        $attributes['order_id'] = request()->order->id;
//        dd($attributes);
        OrderReport::create($attributes);

        return redirect()->to(route('orders'))->with('message', 'Adres został pomyślnie dodany do konta.');
    }
}
