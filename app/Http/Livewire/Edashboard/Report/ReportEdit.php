<?php

namespace App\Http\Livewire\Edashboard\Report;

use App\Models\User;
use Livewire\Component;

class ReportEdit extends Component
{
    public $report;

    public $status;

    public $selected_status;

    public $editor_name;

    public function mount()
    {
        $this->report = request()->report;

        $this->status = $this->report->status;
        if ($this->report->edited_by !== 0)
        {
            $this->editor_name = User::find($this->report->edited_by)->name;
        }
    }

    public function saveReport()
    {
        $this->report->status = $this->status;
        $this->report->edited_by = auth()->user()->id;
        $this->report->save();
        session()->flash('message', 'Zgłoszenie zostało zaktualizowane.');

    }

    public function setReportStatus($status)
    {
        $this->status = $status;
    }


    public function render()
    {
        return view('livewire.edashboard.report.report-edit');
    }
}
