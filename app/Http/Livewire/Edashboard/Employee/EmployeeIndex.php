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

//    public $employee_users = [];

    public function mount(Employee $employee, Role $role, User $user)
    {
        $this->employees = Employee::all();
//        foreach ($this->employees as $employee)
//        {
//            //dd(auth()->user()->getRelations());
//            $user = User::find($employee->user_id);
//            array_push($this->employee_users, $user);
//        }
        //dd($this->employee_users);
//        foreach ($this->employees as $employee)
//        {
//            dd($user->employee->name);
//        }
    }


//    public function setMessage()
//    {
//        session()->flash('message', 'Szukanie ' . $this->a . ' w czy znajduje się w grupie pracowników...');
//    }


    public function clearNameInput()
    {
        $this->fullname_input = '';
        unset($this->searched_employee);
    }

    public function getEmployeeDetailsByName()
    {
        $fullname = $this->fullname_input;
        //dd($fullname);
        if (isset($fullname) and empty($fullname) !== true)
        {
            $user = User::where('name', $fullname)->first();
            if (isset($user->exists) and $user->exists == true) {
                $employee_details = Employee::where('user_id', $user->id)->first();
                if (isset($employee_details->exists) and $employee_details->exists == true) {
                    //return $employee_details;
                    //dd($employee_details);
                    //session()->flash('message', 'Użytkownik ' . $fullname . ' jest pracownikiem. Naciśnij tutaj, aby zobaczyć szczegóły.');

                    $this->searched_employee = $employee_details;
                    //return $employee_details;
                }
                else
                {
                    //return null;
                    session()->flash('message', 'Użytkownik ' . $fullname . ' odnaleziony w bazie danych. Brak informacji dot. szczegółów pracy.');
                    //dd('Użytkownik ' . $fullname . ' odnaleziony w bazie danych. Brak informacji dot. szczegółów pracy.');
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
            //return null;
        }
    }

    public function render()
    {
        return view('livewire.edashboard.employee.employee-index');
    }
}
