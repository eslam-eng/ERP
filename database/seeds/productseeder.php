<?php

use Illuminate\Database\Seeder;

class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = \App\Store::where('name','store1')->first();
//        $category = \App\Category::where('name','category1')->first();
        $product1 = new \App\Product();
        $product1->name = 'Product1';
        $product1->qty = 10;
        $product1->isactive = 1;
        $product1->store = $store->id;
//        $product1->category = $category->id;
        $product1->save();

        $product2 = new \App\Product();
        $product2->name = 'Product2';
        $product2->qty = 10;
        $product2->isactive = 1;
        $product2->store = $store->id;
//        $product2->category = $category->id;
        $product2->save();

    }
}
