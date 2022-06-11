<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function getAmountOfMembers($id)
    {
        if (isset($id))
        {
            $count = Employee::where('role_id', $id)->count();
            //$count = $this->where('id', $id)->count();
        }
        else
        {
            $count = 0;
        }
        return $count;
    }
}
