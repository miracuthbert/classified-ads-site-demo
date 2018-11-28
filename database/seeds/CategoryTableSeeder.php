<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Listing',
                'children' => [
                    [
                        'name' => 'Community',
                        'children' => [
                            ['name' => 'Activities'],
                            ['name' => 'Artists'],
                            ['name' => 'Childcare'],
                            ['name' => 'Classes'],
                            ['name' => 'Events'],
                            ['name' => 'General'],
                            ['name' => 'Groups'],
                            ['name' => 'Local news'],
                            ['name' => 'Lost and found'],
                            ['name' => 'Musicians'],
                            ['name' => 'Pets'],
                            ['name' => 'Politics'],
                            ['name' => 'Rideshare'],
                            ['name' => 'Volunteers'],
                        ]
                    ],
                    [
                        'name' => 'Personals',
                        'children' => [
                            ['name' => 'Women seeking men'],
                            ['name' => 'Men seeking women'],
                            ['name' => 'Misc romance'],
                            ['name' => 'Casual encounters'],
                            ['name' => 'Missed connections'],
                            ['name' => 'Rants and raves'],
                        ]
                    ],
                    [
                        'name' => 'Housing',
                        'children' => [
                            ['name' => 'Apartments / housing'],
                            ['name' => 'Housing swap'],
                            ['name' => 'Housing wanted'],
                            ['name' => 'Office / commercial'],
                            ['name' => 'Parking / storage'],
                            ['name' => 'Real estate for sale'],
                            ['name' => 'Rooms / shared'],
                            ['name' => 'Rooms wanted'],
                            ['name' => 'Sublets / temporary'],
                            ['name' => 'Vacation rentals'],
                        ]
                    ],
                    [
                        'name' => 'Services',
                        'children' => [
                            ['name' => 'Automotive'],
                            ['name' => 'Beauty'],
                            ['name' => 'Cell Phones & Smart Phones'],
                            ['name' => 'Computer'],
                            ['name' => 'Creative'],
                            ['name' => 'Cycle'],
                            ['name' => 'Event'],
                            ['name' => 'Farm / Garden'],
                            ['name' => 'Financial'],
                            ['name' => 'Household'],
                            ['name' => 'Labor / Move'],
                            ['name' => 'Legal'],
                            ['name' => 'Lessons'],
                            ['name' => 'Marine'],
                            ['name' => 'Animals / Birds / Pets'],
                            ['name' => 'Real Estate'],
                            ['name' => 'Skilled Trade'],
                            ['name' => 'Small Biz Ads'],
                            ['name' => 'Therapeutic'],
                            ['name' => 'Travel / Holidays / Vacations'],
                            ['name' => 'Writing / Editing/ Translation'],
                        ]
                    ],
                    [
                        'name' => 'For Sale',
                        'children' => [
                            ['name' => 'Antique / Vintage'],
                            ['name' => 'Appliances'],
                            ['name' => 'Arts & Crafts'],
                            ['name' => 'Auto Parts'],
                            ['name' => 'Babies / Kids'],
                            ['name' => 'Barter / Exchange '],
                            ['name' => 'Beauty / Health'],
                            ['name' => 'Bikes'],
                            ['name' => 'Boats'],
                            ['name' => 'Books'],
                            ['name' => 'Business'],
                            ['name' => 'Cars / Trucks'],
                            ['name' => 'CDs / DVDs / VHS'],
                            ['name' => 'Cell Phones & Accessories'],
                            ['name' => 'Clothes & Accessories'],
                            ['name' => 'Collectibles'],
                            ['name' => 'Computers & Tablets'],
                            ['name' => 'Electronics'],
                            ['name' => 'Farm / Garden'],
                            ['name' => 'Free'],
                            ['name' => 'Furniture'],
                            ['name' => 'Garage Sale'],
                            ['name' => 'General'],
                            ['name' => 'Heavy equipment'],
                            ['name' => 'House Hold'],
                            ['name' => 'Jewellery'],
                            ['name' => 'Materials'],
                            ['name' => 'Motorcycles'],
                            ['name' => 'Music Instruments'],
                            ['name' => 'Mountain & Camping Equipments'],
                            ['name' => 'Sporting'],
                            ['name' => 'Tickets'],
                            ['name' => 'Tools'],
                            ['name' => 'Toys & Games'],
                            ['name' => 'Trailers'],
                            ['name' => 'Video Games & Consoles'],
                            ['name' => 'Wanted'],
                        ]
                    ],
                ]
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }


    }
}
