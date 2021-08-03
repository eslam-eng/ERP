<?php

use Illuminate\Database\Seeder;

class storeseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = new \App\Store();
        $store->name = 'store1';
        $store->desc = 'the main store';
        $store->isactive = 1;
        $store->save();
    }
}
