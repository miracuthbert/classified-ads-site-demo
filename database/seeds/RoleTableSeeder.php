<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        factory(\App\Models\Role::class, 1)->create([
            'title' => 'Admin',
            'details' => 'Can perform all CRUD actions.',
            'policies' => [
                [
                    'name' => 'Admin',
                    'model' => \App\Models\Admin::class,
                    'actions' => [
                        'view' => 1,
                        'create' => 1,
                        'update' => 1,
                        'delete' => 1,
                        'touch' => 1,
                    ],
                ],
                [
                    'name' => 'Users',
                    'model' => \App\User::class,
                    'actions' => [
                        'view' => 1,
                        'create' => 1,
                        'update' => 1,
                        'delete' => 1,
                        'touch' => 1,
                    ],
                ],
                [
                    'name' => 'Listings',
                    'model' => \App\Models\Listing::class,
                    'actions' => [
                        'view' => 1,
                        'create' => 1,
                        'update' => 1,
                        'delete' => 1,
                        'touch' => 1,
                    ],
                ],
            ],
        ]);

        //managers
        factory(\App\Models\Role::class, 1)->create([
            'title' => 'Editors',
            'details' => 'Can perform all read, update and delete(or block) actions on listings and users.',
            'policies' => [
                [
                    'name' => 'Admin',
                    'model' => \App\Models\Admin::class,
                    'actions' => [
                        'view' => 1,
                        'create' => 0,
                        'update' => 0,
                        'delete' => 0,
                        'touch' => 0,
                    ],
                ],
                [
                    'name' => 'Users',
                    'model' => \App\User::class,
                    'actions' => [
                        'view' => 1,
                        'create' => 1,
                        'update' => 1,
                        'delete' => 0,
                        'touch' => 1,
                    ],
                ],
                [
                    'name' => 'Listings',
                    'model' => \App\Models\Listing::class,
                    'actions' => [
                        'view' => 1,
                        'create' => 1,
                        'update' => 1,
                        'delete' => 0,
                        'touch' => 1,
                    ],
                ],
            ],
        ]);

        //editors
        factory(\App\Models\Role::class, 1)->create([
            'title' => 'Moderator',
            'details' => 'Can perform all read, update and delete(block) listings.',
            'policies' => [
                [
                    'name' => 'Admin',
                    'model' => \App\Models\Admin::class,
                    'actions' => [
                        'view' => 1,
                        'create' => 0,
                        'update' => 0,
                        'delete' => 0,
                        'touch' => 0,
                    ],
                ],
                [
                    'name' => 'Users',
                    'model' => \App\User::class,
                    'actions' => [
                        'view' => 1,
                        'create' => 1,
                        'update' => 1,
                        'delete' => 0,
                        'touch' => 1,
                    ],
                ],
                [
                    'name' => 'Listings',
                    'model' => \App\Models\Listing::class,
                    'actions' => [
                        'view' => 1,
                        'create' => 1,
                        'update' => 1,
                        'delete' => 0,
                        'touch' => 1,
                    ],
                ],
            ],
        ]);

        //assign role
        $user = \App\User::find(1);
        $role = \App\Models\Role::where('slug', 'admin')->first();
        $user->roles()->syncWithoutDetaching([$role->id]);
    }
}
