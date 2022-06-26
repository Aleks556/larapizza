<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class TestForm extends Component
{

    //Form details
    public int $max_step = 4;
    public int $step = 1;

    public $addresses;
    public $selected_address;
    public $selected_address_fullname;

    public $delivery;


    public $items_catalog = [];


    public array $items_cart = [];


    public $price = 0;
    public $payment_type;
    public $comment = '';
    public $phone_number;

    public $order_details = [];

    protected $rules = [
        'comment' => 'max:300',
        'payment_type' => 'required',
        'phone_number' => 'required|numeric|digits:9'
    ];

    public function mount(Address $address, Item $item)
    {
        $this->addresses = Address::all();
        $this->items_catalog = Item::all();
    }



    public function chooseDelivery($aid = null)
    {

        if (isset($aid))
        {
            $this->delivery = 1;
            $this->selectAddress($aid);
        }
        else
        {
            $this->delivery = 0;
            unset($this->selected_address);
            unset($this->selected_address_fullname);
            $this->step++;
        }

    }

    public function selectAddress($aid)
    {
        $this->selected_address = $this->addresses->find($aid);
        $this->selected_address_fullname = $this->getFullAddressName();
        $this->delivery = 1;
        $this->step++;
    }

    public function setPaymentType($pType)
    {
        unset($this->payment_type);
        if (isset($pType) && is_int($pType))
        {
            $this->payment_type = $pType;
        }
    }

    public function getFullAddressName(): string
    {
        if (isset($this->selected_address->street) && isset($this->selected_address->number))
        {
            if (isset($this->selected_address->flat))
            {
                return $this->selected_address->street . ' ' . $this->selected_address->number . ' / ' . $this->selected_address->flat;
            }
            else
            {
                return $this->selected_address->street . ' / ' . $this->selected_address->number;
            }
        }
        else
        {
            return 'Coś poszło nie tak...';
        }
    }

    public function addItem($selectedItem)
    {
        array_push($this->items_cart, [$this->getFreeSlot(), $selectedItem['name'], $selectedItem['price'], $selectedItem['category']['id'], $selectedItem['category']['name'], $selectedItem['id']]);
        $this->calculatePrice();
    }

    public function deleteItem($selectedItem)
    {
        if ($this->items_cart != null && count($this->items_cart) == 1)
        {
            $this->items_cart = array();
        }
        if (isset($this->items_cart[$selectedItem[0]]))
        {
            unset($this->items_cart[$selectedItem[0]]);
            foreach ($this->items_cart as $item)
            {
                $item[0] = $this->getFreeSlot();
            }
        }
        $this->calculatePrice();
    }


    public function getFreeSlot(): int
    {
        if (isset($this->items_cart)){
            for ($i = 0; $i <= count($this->items_cart); $i++)
            {
                if (!array_key_exists($i, $this->items_cart))
                {
                    return $i;
                }
            }
            return count($this->items_cart);
        }
        else
        {
            return 0;
        }
    }

    public function calculatePrice()
    {
        $this->price = 0;
        foreach ($this->items_cart as $item)
        {
            $this->price = $this->price + $item[2];
        }
        return $this->price;
    }

    public function previousStep()
    {
        if ($this->step > 1)
        {
            $this->step--;
        }
    }
    public function makeOrder()
    {
        if ($this->delivery == 0)
        {
            $this->validate();
            $saved_order =  Order::create([
                'user_id' => auth()->user()->id,
                'address_id' => 0,
                'price' => $this->price,
                'comment' => $this->comment,
                'payment' => $this->payment_type,
                'delivery' => $this->delivery,
                'phone_number' => $this->phone_number
            ]);
        }
        else
        {
            $this->validate();
            $saved_order =  Order::create([
                'user_id' => auth()->user()->id,
                'address_id' => $this->selected_address->id,
                'price' => $this->price,
                'comment' => $this->comment,
                'payment' => $this->payment_type,
                'delivery' => $this->delivery,
                'phone_number' => $this->phone_number,
                'street' => $this->selected_address->street,
                'number' => $this->selected_address->number,
                'flat' => $this->selected_address->flat,
                'city' => $this->selected_address->city,
                'zipcode' => $this->selected_address->zipcode
            ]);
        }

        if ($saved_order->wasRecentlyCreated){
            foreach ($this->items_cart as $item)
            {
                OrderItem::create([
                    'order_id' => $saved_order->id,
                    'item_id' => $item[5],
                ]);
            }
        }
    }

    public function nextStep()
    {
        if ($this->step < $this->max_step)
        {
            if ($this->step == 2)
            {
                if (!$this->isCartEmpty())
                {
                    $this->step++;
                }
                else
                {
                    session()->flash('message', "Nie można przejść do następnego kroku, ponieważ nie wybrano żadnego produktu do zamówienia.");
                }
            }
            elseif ($this->step == 3)
            {
                if (isset($this->payment_type))
                {
                    $this->validate();
                    $this->makeOrder();
                    $this->step = $this->max_step;
                }
                else
                {
                    session()->flash('message', "Nie można przejść do następnego kroku, ponieważ nie wybrano sposobu płatności.");
                }
            }
            else
            {
                $this->step++;
            }
        }
    }
    public function isCartEmpty(): bool
    {
        $items_count = count($this->items_cart);
        if ($items_count > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }


    public function render()
    {
        return view('livewire.test-form', [
            'addresses' => $this->addresses,
            'items' => $this->items_catalog,
            'price' => $this->price,
            'order_details' => $this->order_details
        ]);
    }
}
