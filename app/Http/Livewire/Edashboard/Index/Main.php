<?php

namespace App\Http\Livewire\Edashboard\Index;

use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderReport;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Main extends Component
{

    //zmiana / shift

    public $shift;

    public $reports_count;

    public $orders;

    public $employees_on_shift;

    public $employees_on_shift_count;

    public $orders_count_to_text;

    //ilość dzisiejszych zamówień
    public int $today_orders_count;


    //ilość zgloszeń do zamówień
    public int $order_reports;

    public function mount(Order $orders, OrderReport $orderReport)
    {
        $this->orders = Order::whereDate('created_at', Carbon::today())->get();
        $this->today_orders_count = count($this->orders);
        $this->orders_count_to_text = $this->ordersCountToText();

        $this->reports_count = OrderReport::whereDate('created_at', Carbon::today())->count();

        $this->employees_on_shift = Shift::where('active', 1)->where('ended_at', null)->get();

        //shift
        $employee = Employee::where('user_id', auth()->user()->id)->first();
        if (isset($employee->exists))
        {
            $this->shift = Shift::where('employee_id', $employee->id)->latest('id')->first();
            if (!isset($this->shift->ended_at) or $this->shift->ended_at == null)
            {
                if (isset($this->shift->created_at))
                {
                    $time_from_start = $this->shift->created_at->diffInHours();
                    if ($time_from_start > 9)
                    {
                        session()->flash('message', 'Poprzednia zmiana została zakończona automatycznie z 2 godzinną długością przepracownego czasu.');
                        $this->endShiftBySystem();
                        $this->startShift();
                    }
                }
            }
        }
    }

    public function refreshPanel()
    {
        $this->orders = Order::whereDate('created_at', Carbon::today())->get();
        $this->today_orders_count = count($this->orders);
        $this->orders_count_to_text = $this->ordersCountToText();
        $this->employees_on_shift_count = count($this->employees_on_shift);
    }


    public function startShift()
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();
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
                        $this->shift = $new_shift;
                    }
                }
                else
                {
                    $time_from_start = $db_shift->created_at->diff()->h;
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
                                $this->shift = $new_shift;
                            }
                        }
                    }
                }
            }
            else
            {
                $new_shift = Shift::create([
                    'employee_id' => $employee->id,
                    'active' => 1,
                ]);
                $this->shift = $new_shift;
            }
        }
    }

    public function endShiftBySystem()
    {
        if (isset($this->shift))
        {
            $employee = Employee::where('id', $this->shift->employee_id)->first();
            $employee->shift_id = 0;
            $employee->save();
            $this->shift->ended_at = Carbon::create($this->shift->created_at)->addHours(2);
            $this->shift->ended_by = 0;
            $this->shift->active = 0;
            $this->shift->save();
            unset($this->shift);
        }
    }

    public function endShiftByEmployee()
    {
        if (isset($this->shift))
        {
            $employee = Employee::where('id', $this->shift->employee_id)->first();
            $employee->shift_id = 0;
            $employee->save();
            $this->shift->ended_at = Carbon::now();
            $this->shift->ended_by = auth()->user()->id;
            $this->shift->active = 0;
            $this->shift->save();
            unset($this->shift);
        }
    }



    public function ordersCountToText()
    {
        if (isset($this->today_orders_count))
        {
            if ($this->today_orders_count == 0)
            {
                return 'zamówień';
            }
            elseif ($this->today_orders_count == 1)
            {
                return 'zamówienie';
            }
            elseif ($this->today_orders_count > 1 && $this->today_orders_count < 5)
            {
                return 'zamówienia';
            }
            else
            {
                return 'zamówień';
            }
        }
        else
        {
            return 'zamówień';
        }
    }

    public function render()
    {
        return view('livewire.edashboard.index.main');
    }
}
