<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index(Shift $shift, Employee $employee, Role $role)
    {
        if (hasRole(auth()->user()->getUserEid(), 2))
        {
            $employees_on_shift = Employee::where('shift_id', '!=', 0)->get();
            $shift = Shift::where('active', 1)->get();

            $shifts_today = Shift::whereDate('created_at', Carbon::today())->get();

            foreach ($shifts_today as $shift_today)
            {
                if (isset($shift_today->ended_at))
                {
                    $shift_today->ended_at = Carbon::create($shift_today->ended_at);
                }
            }

            return view('edashboard.shift.index', [
                'employees' => $employees_on_shift,
                'shifts' => $shift,
                'shifts_today' => $shifts_today
            ]);
        }
        return sendPermissionMsgAndReRoute('Nie posiadasz odpowiednich uprawnień do wyświetlenia tej strony.');
    }
}
