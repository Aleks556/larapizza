<?php

namespace App\Http\Controllers;

use App\Models\Address;

class AddressController extends Controller
{
    public function index(Address $address)
    {
        return view('address.index', [
            'addresses' => Address::all()
        ]);
    }
    public function create()
    {
        return view('address.create');
    }
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|min:3|max:50',
            'street' => 'required|min:3|max:50',
            'number' => 'required',
            'flat' => 'max:50',
            'city' => 'required|min:3|max:50',
            'zipcode' => 'regex:/^(?:\d{2}-\d{3})$/i'
        ]);
        $attributes['user_id'] = request()->user()->id;


        Address::create($attributes);

        return redirect()->to(route('addresses'))->with('message', 'Adres został pomyślnie dodany do konta.');
    }
    public function edit(Address $address)
    {
        return view('address.edit', [
            'address' => $address
        ]);
    }
    public function update(Address $address)
    {
        $attributes = request()->validate([
            'name' => 'required|min:3|max:50',
            'street' => 'required|min:3|max:50',
            'number' => 'required',
            'flat' => 'max:50',
            'city' => 'required|min:3|max:50',
            'zipcode' => 'regex:/^(?:\d{2}-\d{3})$/i'
        ]);
        $attributes['user_id'] = request()->user()->id;
        $address->update($attributes);

        return redirect(route('addresses'));
    }
    public function delete(Address $address)
    {
        $address->delete();

        return redirect()->to(route('addresses'))->with('message', 'Adres został pomyślnie usunięty z bazy danych.');
    }
}
