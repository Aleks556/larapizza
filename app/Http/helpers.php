<?php

//namespace App\Http;

use App\Models\Employee;
use App\Models\Shift;
use Carbon\Carbon;


if (!function_exists('startShift'))
{
    function startShift($eid = null)
    {
        if (isset($eid))
        {
            $employee = Employee::where('user_id', $eid)->first();
        }
        else
        {
            $employee = Employee::where('user_id', auth()->user()->id)->first();
        }
        if (isset($employee->exists))
        {
            $db_shift = Shift::where('employee_id', $employee->id)->latest('created_at')->first();
            if (isset($db_shift->created_at))
            {
                if (isset($db_shift->ended_at))
                {
                    $new_shift = Shift::create([
                        'employee_id' => $employee->id,
                        'active' => 1,
                    ]);
                    if ($new_shift->wasRecentlyCreated)
                    {
                        $employee->shift_id = $new_shift->id;
                        $employee->save();
                    }
                }
                else
                {
                    $time_from_start = $db_shift->created_at->diffInHours();
                    if (isset($time_from_start))
                    {
                        if ($time_from_start > 9)
                        {
                            $db_shift->ended_at = Carbon::create($db_shift->created_at)->addHours(2);
                            $db_shift->active = 0;
                            $db_shift->ended_by = 0;
                            $db_shift->save();
                            $new_shift = Shift::create([
                                'employee_id' => $employee->id,
                                'active' => 1,
                            ]);
                            if ($new_shift->wasRecentlyCreated)
                            {
                                $employee->shift_id = $new_shift->id;
                                $employee->save();
                            }
                        }
                    }
                }
            }
            else
            {
                Shift::create([
                    'employee_id' => $employee->id,
                    'active' => 1,
                ]);
            }
        }
    }
}

if (!function_exists('endShift'))
{
    function endShift($eid = null, $ended_by = 0)
    {
        if (isset($eid))
        {
            $employee = Employee::find($eid);
            $shift = Shift::where('employee_id', $eid)->where('active', 1)->first();
            if (isset($shift->exists) and $shift->exists == true)
            {
                $employee->shift_id = 0;
                $employee->save();
                $shift->ended_at = Carbon::now();
                $shift->ended_by = $ended_by;
                $shift->active = 0;
                $shift->save();
            }
        }
    }
}

if (!function_exists('getEmployeeRole'))
{
    function getEmployeeRole($eid = null)
    {
        if (isset($eid))
        {
            $employee = Employee::find($eid);
        }
        else
        {
            $employee = Employee::find(auth()->user()->id);
        }
        if (isset($employee->exists))
        {
            return $employee->role;
        }
    }
}

if (!function_exists('hasRole'))
{
    function hasRole($eid, $role_level)
    {
        if (isset($eid) && isset($role_level))
        {
            $employee = Employee::find($eid);
            if (isset($employee->exists))
            {
                if ($employee->role->level >= $role_level)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }
}

if (!function_exists('sendPermissionMsgAndReRoute'))
{
    function sendPermissionMsgAndReRoute($msg = '', $type = 'danger')
    {
        session()->flash('flash.banner', $msg);
        session()->flash('flash.bannerStyle', $type);
        return back()->withInput();
    }
}
