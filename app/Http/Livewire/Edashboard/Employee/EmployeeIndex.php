<?php

namespace App\Http\Livewire\Edashboard\Employee;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use App\Rules\FullName;
use Livewire\Component;

class EmployeeIndex extends Component
{

    protected $rules = [
        'fullname_input' =>'required|string|min:1|max:255|new FullName()',
    ];

    public $fullname_input;

    public $employees;

    public $searched_employee;


    public function mount(Employee $employee, Role $role, User $user)
    {
        $this->employees = Employee::all();
    }





    public function clearNameInput()
    {
        $this->fullname_input = '';
        unset($this->searched_employee);
    }

    public function getEmployeeDetailsByName()
    {
        $fullname = $this->fullname_input;
        if (isset($fullname) and empty($fullname) !== true)
        {
            $user = User::where('name', $fullname)->first();
            if (isset($user->exists) and $user->exists == true) {
                $employee_details = Employee::where('user_id', $user->id)->first();
                if (isset($employee_details->exists) and $employee_details->exists == true)
                {
                    $this->searched_employee = $employee_details;
                }
                else
                {
                    session()->flash('message', 'Użytkownik ' . $fullname . ' odnaleziony w bazie danych. Brak informacji dot. szczegółów pracy.');
                }
            }
            else
            {
                session()->flash('message', 'Użytkownik ' . $fullname . ' nie istnieje w bazie danych.');
            }
        }
        else
        {
            session()->flash('message', 'Aby wyszukać osobę należy wpisać imię i nazwisko z dużej litery.');
        }
    }

    public function render()
    {
        return view('livewire.edashboard.employee.employee-index');
    }
}
