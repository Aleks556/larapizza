<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $employees_on_shift = Employee::where('shift_id', '!=', 0)->get();
        $shifts = Shift::where('active', 1)->get();

        return view('edashboard.shift.index', [
            'employees' => $employees_on_shift,
            'shifts' => $shifts,
        ]);
    }
}
