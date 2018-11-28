<?php

use Illuminate\Database\Seeder;
use PragmaRX\Countries\Facade as Countries;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Create a WorldWide Area
        $area = ['name' => 'World Wide'];
        \App\Models\Area::create($area);

        //Create More Countries Below
        $countries = ['Tanzania',/* 'Kenya', 'Uganda'*/];
        $areas = [];
        $i = 0;

        foreach ($countries as $country) {

            $states = Countries::where('name.common', $country)
                ->first()
                ->states
                ->sortBy('name')
                ->pluck('name', 'postal');

            $country_states = [];

            foreach ($states as $state) {
                $_state = ['name' => $state];
                $country_states = array_add($country_states, $i++, $_state);
            }

            $areas = array_merge($areas, [
                [
                    'name' => $country,
                    'children' =>
                        $country_states
                ]
            ]);
        }

        //loop through areas
        foreach ($areas as $area) {
            \App\Models\Area::create($area);
        }

    }
}
