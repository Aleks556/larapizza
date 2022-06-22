<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{


    public function index(Role $role)
    {
        if (hasRole(auth()->user()->getUserEid(), 2))
        {
            return view('edashboard.role.index', [
                'roles' => Role::all(),
            ]);
        }
        return sendPermissionMsgAndReRoute('Nie posiadasz odpowiednich uprawnień do wyświetlenia tej strony.');
    }

    public function edit(Role $role, Employee $employee)
    {
        if (hasRole(auth()->user()->getUserEid(), 3))
        {
            return view('edashboard.role.edit', [
                'role' => $role,
                'employees' => Employee::where('role_id', $role->id)->get(),
            ]);
        }
        return sendPermissionMsgAndReRoute('Nie posiadasz odpowiednich uprawnień do wyświetlenia tej strony.');
    }

    public function create()
    {
        if (hasRole(auth()->user()->getUserEid(), 3))
        {
            return view('edashboard.role.create');
        }
        return sendPermissionMsgAndReRoute('Nie posiadasz odpowiednich uprawnień do wyświetlenia tej strony.');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|min:3|max:50',
            'level' => 'required',
            'pay_rate' => 'required|numeric|max:50|min:1',
        ]);
        $attributes['created_by'] = request()->user()->id;

        try {
            Role::create($attributes);
            session()->flash('flash.banner', "Pomyślnie utworzono stanowisko ". $attributes['name'] . '.');
            session()->flash('flash.bannerStyle', 'success');

            return redirect()->to(route('edashboard.roles'));
        } catch (\Exception $e)
        {
            if ($e->getCode() == 23000)
            {
                session()->flash('flash.banner', "Nie udało się utworzyć stanowiska ". $attributes['name'] . ', ponieważ już takie istnieje.');
                session()->flash('flash.bannerStyle', 'danger');

                return redirect(route('edashboard.role.create'));
            }
        }
    }

    public function update(Role $role)
    {
        $attributes = request()->validate([
            'name' => 'required|min:3|max:50',
            'level' => 'required',
            'pay_rate' => 'required|numeric|max:50|min:1',
        ]);
        //$attributes['user_id'] = request()->user()->id;
        $role->update($attributes);
        session()->flash('flash.banner', 'Pomyślnie zaktualizowano stanowisko ' . $attributes['name'] . '.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(route('edashboard.roles'));
    }
}
