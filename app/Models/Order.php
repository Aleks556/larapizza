<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function report()
    {
        return $this->belongsTo(OrderReport::class);
    }

    public function getStatusName()
    {
        $status = $this->status;
        if ($status == 0)
        {
            return 'Anulowane';
        }
        elseif ($status == 1)
        {
            return 'Przyjęte';
        }
        elseif ($status == 2)
        {
            return 'Realizacja';
        }
        elseif ($status == 3)
        {
            return 'Zakończone';
        }
        else
        {
            return 'Nieznany';
        }
    }
}
