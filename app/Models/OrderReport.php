<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReport extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function order()
    {
        return $this->hasOne(Order::class, 'id');
    }

    public function getStatusName()
    {
        $name = '';
        switch ($this->status)
        {
            case 0:
                $name = 'Anulowane';
                break;
            case 1:
                $name = 'Wysłane';
                break;
            case 2:
                $name = 'Przyjęte - w trakcie postępowania';
                break;
            case 3:
                $name = 'Zakończone';
                break;
        }
        return $name;
    }

    public function getProblem()
    {
        $name = '';
        switch ($this->problem)
        {
            case 1:
                $name = 'Chcę edytować zamówienie';
                break;
            case 2:
                $name = 'Zamówienie jest niekompletne';
                break;
            case 3:
                $name = 'Błedne produkty w zamówieniu';
                break;
            case 4:
                $name = 'Zamówienie nie dotarło do mnie';
                break;
            case 5:
                $name = 'Pracownik źle wydał resztę';
                break;
            default:
                $name = 'Nie wybrano';
        }
        return $name;
    }

}
