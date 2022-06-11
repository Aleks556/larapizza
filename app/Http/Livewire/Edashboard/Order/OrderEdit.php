<?php

namespace App\Http\Livewire\Edashboard\Order;

use App\Models\Category;
use App\Models\Item;
use App\Models\OrderItem;
use Livewire\Component;

class OrderEdit extends Component
{
    public $items_catalog;

    public $price;

    public $order;
    public $order_status;
    public $order_payment;
    public $order_delivery;
    public $order_items;

    public $pushed_order_items = [];

    public $address_street;
    public $address_number;
    public $address_flat;
    public $address_city;
    public $address_zipcode;

    public $phone_number;
    public $comment;

    protected $rules = [
        'phone_number' => 'required|numeric|digits:9',
    ];
    protected function rules()
    {
        if ($this->order_delivery == 0)
        {
            return [
                'phone_number' => 'required|numeric|digits:9'
            ];
        }
        else
            return [
                'phone_number' => 'required|numeric|digits:9',
                'address_street' => 'required|string',
                'address_number' => 'required',
                'address_zipcode' => 'required',
                'address_city' => 'required'
            ];
    }

    public function mount(OrderItem $orderItem, Item $item, Category $category)
    {
        $this->order = request()->order;
        $this->order_items = OrderItem::where('order_id', $this->order->id)->get();
        $this->items_catalog = Item::all();


        $this->order_payment = $this->order->payment;
        $this->order_delivery = $this->order->delivery;
        $this->order_status = $this->order->status;
        $this->phone_number = $this->order->phone_number;
        //adres
        $this->address_street = $this->order->street;
        $this->address_number = $this->order->number;
        $this->address_flat = $this->order->flat;
        $this->address_zipcode = $this->order->zipcode;
        $this->address_city = $this->order->city;

        $this->initializeOrderItems($this->order_items);
        //$this->deleteItemFromOrder(0);
//        $this->addItemFromCatalog(3);
//        $this->addItemFromCatalog(3);
//        dd($this->pushed_order_items);
    }

    public function saveOrderChanges()
    {
        if (!isset($this->pushed_order_items) or count($this->pushed_order_items) < 1)
        {
            session()->flash('message', 'Zamówienie musi posiadać minimum 1 produkt.');
        }
        else
        {
            if ($this->order_delivery == 0)
            {
//                dd($this->order);
                //order update
                $this->validate();
                $this->order->status = $this->order_status;
                $this->order->delivery = $this->order_delivery;
                $this->order->payment = $this->order_payment;
                $this->order->phone_number = $this->phone_number;
                $this->order->street = '';
                $this->order->number = '';
                $this->order->flat = '';
                $this->order->zipcode = '';
                $this->order->city = '';
                $this->order->comment = $this->comment;
                $this->order->save();

                $deleted_order_items = OrderItem::where('order_id', $this->order->id)->delete();
                foreach ($this->pushed_order_items as $item)
                {
                    OrderItem::create([
                        'order_id' => $this->order->id,
                        'item_id' => $item['id'],
                    ]);
                }


            }
            else
            {
                $this->validate();
                $this->order->status = $this->order_status;
                $this->order->delivery = $this->order_delivery;
                $this->order->payment = $this->order_payment;
                $this->order->phone_number = $this->phone_number;
                $this->order->street = $this->address_street;
                $this->order->number = $this->address_number;
                $this->order->flat = $this->address_flat;
                $this->order->zipcode = $this->address_zipcode;
                $this->order->city = $this->address_city;
                $this->order->comment = $this->comment;
                $this->order->save();

                $deleted_order_items = OrderItem::where('order_id', $this->order->id)->delete();
                foreach ($this->pushed_order_items as $item)
                {
                    OrderItem::create([
                        'order_id' => $this->order->id,
                        'item_id' => $item['id'],
                    ]);
                }
            }
            session()->flash('message', 'Zmiany w zamówieniu zostały wprowadzone.');
        }

        //sprawdzenie czy dostawa jesli tak to walidacja adresu jesli pozytywna to zapisujemy do bazy
    }


    public function initializeOrderItems($dbItems)
    {
        if (isset($dbItems))
        {
//            foreach ($dbItems as $item)
//            {
//
//                array_push($this->pushed_order_items, ['slot' => $this->getFreeSlot(), 'id' => $item->id, 'category' => $item->category->name, 'name' => $item->name, 'price' => $item->price]);
//            }
//            dd($this->pushed_order_items);
            //dd($dbItems);
            foreach ($dbItems as $item)
            {
                $this->addItemFromCatalog($item->item->id);
            }
        }
    }

    public function deleteItemFromOrder($item_slot)
    {
        if (isset($this->pushed_order_items) && count($this->pushed_order_items) == 1)
        {
            $this->pushed_order_items = array();
        }
        if (isset($this->pushed_order_items[$item_slot]))
        {
            unset($this->pushed_order_items[$item_slot]);
            foreach ($this->pushed_order_items as $item)
            {
                $item['slot'] = $this->getFreeSlot();
            }
        }
        $this->calculatePrice();
    }

    public function addItemFromCatalog($item_id)
    {
        $item = Item::find($item_id);
//dd($item);
        if ($item->exists)
        {
            array_push($this->pushed_order_items, ['slot' => $this->getFreeSlot(), 'id' => $item->id, 'category' => $item->category->name, 'name' => $item->name, 'price' => $item->price]);
        }
        $this->calculatePrice();
    }

    public function calculatePrice()
    {
        $this->price = 0;
        foreach ($this->pushed_order_items as $item)
        {
            $this->price = $this->price + $item['price'];
        }
        return $this->price;
    }

    public function getFreeSlot(): int
    {
        if (isset($this->pushed_order_items)){
            for ($i = 0; $i < count($this->pushed_order_items); $i++)
            {
                if (!array_key_exists($i, $this->pushed_order_items))
                {
                    return $i;
                }
            }
            return count($this->pushed_order_items);
        }
        else
        {
            return 0;
        }
    }

    public function setOrderStatus($sType)
    {
        if (isset($sType))
        {
            $this->order_status = $sType;
        }
    }

    public function setPaymentType($pType)
    {
        if (isset($pType))
        {
            $this->order_payment = $pType;
        }
    }

    public function setDeliveryType($dType)
    {
        if (isset($dType))
        {
            $this->order_delivery = $dType;
        }
    }

    public function render()
    {
        return view('livewire.edashboard.order.order-edit');
    }
}
