<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

/**
 * User Group Routes
 */
Route::group(['prefix' => '/user'], function () {

    //Persist User Area
    Route::get('/area/{area}', 'User\AreaController@store')->name('user.area.store');

    //User profile
    Route::get('/profile', 'User\ProfileController@edit')->name('user.profile');
    Route::put('/profile/{id}', 'User\ProfileController@update')->name('user.update');

});

/**
 * Messenger Resource Routes
 */
Route::group(['prefix' => '/messenger', 'namespace' => 'Messenger'], function () {

    /**
     * Messenger Messages Resource Routes
     */
    Route::resource('messages', 'MessageController', [
        'names' => [
            'index' => 'messenger.messages.index',
            'create' => 'messenger.messages.create',
            'store' => 'messenger.messages.store',
            'show' => 'messenger.messages.show',
            'edit' => 'messenger.messages.edit',
            'update' => 'messenger.messages.update',
            'destroy' => 'messenger.messages.destroy',
        ]
    ]);
});

/**
 * Messenger Resource Routes
 */
Route::resource('messenger', 'Messenger\MessengerController');

/**
 * Admin Group Routes
 */
Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => ['admin']], function () {

    //Dashboard Route
    Route::get('/dashboard', 'DashboardController')->name('admin.dashboard');


    /**
     * Roles Group Route
     */
    Route::group(['prefix' => '/roles', 'namespace' => 'Role'], function () {
        Route::put('/{role}/sync', 'RoleSyncController')->name('admin.roles.sync');
    });

    /**
     * Roles Resource Route
     */
    Route::resource('roles', 'Role\RoleController', [
        'names' => [
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'show' => 'admin.roles.show',
            'edit' => 'admin.roles.edit',
            'update' => 'admin.roles.update',
            'destroy' => 'admin.roles.destroy',
        ]
    ]);

    /**
     * Users Group Route
     */
//    Route::group(['prefix' => '/users', 'namespace' => 'User'], function () {
//    });

    /**
     * Users Resource Route
     */
    Route::resource('users', 'User\UserController', [
        'names' => [
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]
    ]);

    /**
     * Listings Group Routes
     */
    Route::group(['prefix' => '/listings', 'namespace' => 'Listing'], function () {

        //index live listings route
        Route::post('/search/published', 'ListingPublishedIndexController')->name('admin.listings.search.published');

        //remove unpublished listings indexes route
        Route::post('/search/unpublished', 'ListingUnpublishedIndexController')->name('admin.listings.search.unpublished');

        //reset listings index route
        Route::post('/search/reset', 'ListingResetIndexController')->name('admin.listings.search.reset');
    });

    /**
     * Listings Resource Routes
     */
    Route::resource('listings', 'Listing\ListingController', [
        'names' => [
            'index' => 'admin.listings.index',
            'create' => 'admin.listings.create',
            'store' => 'admin.listings.store',
            'show' => 'admin.listings.show',
            'edit' => 'admin.listings.edit',
            'update' => 'admin.listings.update',
            'destroy' => 'admin.listings.destroy',
        ]
    ]);

    //Areas Group Routes

    //Categories Group Routes

});

/**
 * Area Group Routes
 */
Route::group(['prefix' => '/{area}'], function () {

    /**
     * Category Group Routes
     */
    Route::group(['prefix' => '/categories'], function () {
        Route::group(['prefix' => '/{category}'], function () {

            //Listing index route
            Route::get('/listings', 'Listing\ListingController@index')->name('listings.index');
        });
    });

    /**
     * Category Resource Routes
     */
    Route::resource('categories', 'Category\CategoryController', [
        'except' => ['create', 'edit', 'update', 'destroy'],
        'names' => [
            'show' => 'category.show',
        ],
    ]);

    /**
     * Listings Group Routes
     */
    Route::group(['prefix' => '/listings', 'namespace' => 'Listing'], function () {
        /**
         * Listing Favourites Routes
         */
        Route::get('/favourites', 'ListingFavouriteController@index')->name('listings.favourite.index');
        Route::post('/{listing}/favourites', 'ListingFavouriteController@store')->name('listings.favourite.store');
        Route::delete('/{listing}/favourites', 'ListingFavouriteController@destroy')->name('listings.favourite.destroy');

        /**
         * Listing Viewed Routes
         */
        Route::get('/viewed', 'ListingViewedController@index')->name('listings.viewed.index');

        /**
         * Listing Contact Routes
         */
        Route::post('/{listing}/contact', 'ListingContactController@store')->name('listings.contact.store');

        /**
         * Listing Management Routes
         */
        //unpublished listings route
        Route::get('/unpublished', 'ListingUnpublishedController')->name('listings.unpublished.index');

        //published listings route
        Route::get('/published', 'ListingPublishedController')->name('listings.published.index');

        //deleted listings route
        Route::get('/deleted', 'ListingDeletedController')->name('listings.deleted.index');

        /**
         * Listing Routes
         */
        Route::group(['prefix' => '/{listing}'], function () {

            /**
             * Listing share routes
             */
            Route::get('/share', 'ListingShareController@index')->name('listings.share.index');
            Route::post('/share', 'ListingShareController@store')->name('listings.share.store');

            //Listing Delete Route
            Route::delete('/delete', 'ListingDeleteController')->name('listings.delete');
            Route::put('/restore', 'ListingRestoreController')->name('listings.restore');

            /**
             * Listing Payment Routes
             */
            Route::get('/mpesa', 'ListingMpesaController@create')->name('listings.payment.mpesa');
            Route::put('/payment', 'ListingPaymentController@update')->name('listings.payment.update');

            /**
             * Payment Resource Routes
             */
            Route::resource('payment', 'ListingPaymentController', [
                'except' => ['index', 'edit', 'update', 'destroy'],
                'names' => [
                    'create' => 'listings.payment.create',
                    'store' => 'listings.payment.store',
                ],
            ]);

        });

    });

    /**
     * Listings Resource Routes
     */
    Route::resource('listings', 'Listing\ListingController', [
        'except' => ['index'],
    ]);
});
