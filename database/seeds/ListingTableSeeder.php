<?php

use Illuminate\Database\Seeder;

class ListingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::all()->each(function ($u) {
            $u->listings()->save(factory(\App\Models\Listing::class)->make());
        });
//        factory(\App\Models\Listing::class, 50)->create();
    }
}
