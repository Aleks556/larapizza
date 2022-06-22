<?php

namespace App\Http\Livewire\Edashboard\Employee;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $email;

    public $found_user;

    public $phone_number;

    public $address_street;
    public $address_number;
    public $address_flat;
    public $address_zipcode;
    public $address_city;

    public $selected_role;
    public $student;

    public $role = 0;

    public $db_roles;

    protected $rules = [
        'phone_number' => 'required|numeric|digits:9',
        'address_street' => 'required|string',
        'address_number' => 'required',
        'address_zipcode' => 'regex:/^(?:\d{2}-\d{3})$/i',
        'address_city' => 'required',
        'role' => 'required|gt:0',
        'student' => 'required',
        'found_user' => 'required'
    ];

    public function mount()
    {
        $this->db_roles = Role::all();
    }

    public function setRole($role_id)
    {
        if (isset($role_id))
        {
            $this->role = $role_id;


        }
    }

    public function setStudent($student)
    {
        if (isset($student))
        {
            $this->student = $student;
        }
    }

    public function getUserByEmail()
    {
        unset($this->found_user);
        if (isset($this->email))
        {
            $user = User::where('email', $this->email)->first();
            if (isset($user->exists) && $user->exists == true)
            {
                $employee = Employee::where('user_id', $user->id)->first();
                if (isset($employee->exists) && $employee->exists == true)
                {
                    session()->flash('email_message', 'Użytkownik o podanym adresie email posiada już profil pracownika o ID '. $employee->id .'!');
                }
                else
                {
                    $this->found_user = $user;
                    session()->flash('email_message', 'Konto '. $this->found_user->name .' o adresie email '. $this->found_user->email .' dołączone do przyszłego profilu pracownika.');


                }
            }
            else
            {
                session()->flash('email_message', 'Nie znaleziono użytkownika o podanym adresie email.');
            }
        }
    }

    public function addEmployee()
    {
        $this->validate();

        $employee = Employee::create([
            'role_id' => $this->role,
            'user_id' => $this->found_user->id,
            'phone_number' => $this->phone_number,
            'address_street' => $this->address_street,
            'address_number' => $this->address_number,
            'address_flat' => $this->address_flat,
            'address_zipcode' => $this->address_zipcode,
            'address_city' => $this->address_city,
            'student' => $this->student
        ]);
        if ($employee->wasRecentlyCreated)
        {
            session()->flash('flash.banner', 'Pracownik został pomyślnie utworzony w bazie danych.');
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->to(route('edashboard.employees'));
        }
        else
        {
            session()->flash('message', 'Nie udało się dodać nowego pracownika do bazy danych.');
        }
    }

    public function render()
    {
        return view('livewire.edashboard.employee.create');
    }
}
