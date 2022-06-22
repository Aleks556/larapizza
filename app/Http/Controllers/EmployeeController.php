<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        if (hasRole(auth()->user()->getUserEid(), 1))
        {
            return view('edashboard.employee.index');
        }
        return sendPermissionMsgAndReRoute('Nie posiadasz odpowiednich uprawnień do wyświetlenia tej strony.');
    }

    public function create()
    {
        if (hasRole(auth()->user()->getUserEid(), 3))
        {
            return view('edashboard.employee.create');
        }
        return sendPermissionMsgAndReRoute('Nie posiadasz odpowiednich uprawnień do wyświetlenia tej strony.');
    }

    public function edit(Employee $employee, Shift $shift, Role $role)
    {
        if (hasRole(auth()->user()->getUserEid(), 3))
        {
            $roles = Role::all();
            $shift_d = Shift::where('employee_id', $employee->id)->latest('created_at')->first();
            return view('edashboard.employee.details', [
                'employee' => $employee,
                'shift' => $shift_d,
                'roles' => $roles,
            ]);
        }
        return sendPermissionMsgAndReRoute('Nie posiadasz odpowiednich uprawnień do wyświetlenia tej strony.');
    }

    public function update(Employee $employee, User $user)
    {
        $attributes = request()->validate([
            'phone_number' => 'required|numeric|digits:9',
            'role_id' => 'required',
            'student' => 'required'
        ]);
        $employee->find($employee->id);
        $employee->phone_number = $attributes['phone_number'];
        $employee->role_id = $attributes['role_id'];
        $employee->student = $attributes['student'];
        $employee->save();
        session()->flash('flash.banner', 'Pomyślnie zaktualizowano dane pracownika ' . $employee->user->name . '.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(route('edashboard.employees'));
    }

    public function delete(Employee $employee)
    {
        //$shifts = Shift::where('employee_id', $employee->id)->get();
        //$shifts->deleted();
        $employee->deleteOrFail();

        session()->flash('flash.banner', 'Pomyślnie zwolniono pracownika oraz usunięto jego zmiany w bazie danych.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->to(route('edashboard.employees'));
    }

    public function endEmployeeShift(Employee $employee)
    {
        if (isset($employee->id))
        {
            $ended_by = auth()->user()->id;
            endShift($employee->id, $ended_by);
            session()->flash('flash.banner', 'Pomyślnie zakończono zmianę pracownika ' . $employee->user->name . '.');
            session()->flash('flash.bannerStyle', 'success');
            return redirect(route('edashboard.employees'));
        }
        else
        {
            session()->flash('flash.banner', 'Coś poszło nie tak.');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect(route('edashboard.employees'));
        }
    }
}
