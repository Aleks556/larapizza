<?php

namespace App\Http\Livewire\Edashboard\Report;


use App\Models\OrderReport;
use Carbon\Carbon;
use Livewire\Component;

class ReportList extends Component
{
    public $reports;



    public function mount(OrderReport $orderReport)
    {
        $this->reports = OrderReport::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get();

        //dd($orders->orderItem());
    }

    public function render()
    {
        return view('livewire.edashboard.report.report-list');
    }
}
