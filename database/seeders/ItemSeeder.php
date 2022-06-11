<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
           'category_id' => 1,
           'name' => 'Pepperoni',
           'portion' => '32cm',
           'price' => 19.99
        ]);
        Item::create([
            'category_id' => 1,
            'name' => 'Hawajska',
            'portion' => '32cm',
            'price' => 17.99
        ]);
        Item::create([
            'category_id' => 1,
            'name' => 'Capriciossa',
            'portion' => '32cm',
            'price' => 22.99
        ]);
        Item::create([
            'category_id' => 1,
            'name' => 'Margherita',
            'portion' => '32cm',
            'price' => 15.99
        ]);
        Item::create([
            'category_id' => 3,
            'name' => 'Coca-Cola',
            'portion' => '250ml',
            'price' => 4.99
        ]);
    }
}
