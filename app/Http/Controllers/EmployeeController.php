<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('edashboard.employee.index');
    }

    public function edit(Employee $employee, Shift $shift)
    {
        $shift_d = Shift::where('employee_id', $employee->id)->latest('created_at')->first();
        return view('edashboard.employee.details', [
            'employee' => $employee,
            'shift' => $shift_d,
        ]);
    }
}
