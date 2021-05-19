<?php
/**
 * File name: web.php
 * Last modified: 2020.06.07 at 07:02:57
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */
use Illuminate\Support\Facades\Crypt;

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

Route::get('test/pass',function(){
    dd(Crypt::decrypt('$2y$10$cJ.eMoFL233fuNWmXmX.MOzUR/VlJW.UUgGnRbgHHwdVOR0E/U4QC'));
});

Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();

Route::get('payments/failed', 'PayPalController@index')->name('payments.failed');
Route::get('payments/razorpay/checkout', 'RazorPayController@checkout');
Route::post('payments/razorpay/pay-success/{userId}/{deliveryAddressId?}/{couponCode?}', 'RazorPayController@paySuccess');
Route::get('payments/razorpay', 'RazorPayController@index');

Route::get('payments/paypal/express-checkout', 'PayPalController@getExpressCheckout')->name('paypal.express-checkout');
Route::get('payments/paypal/express-checkout-success', 'PayPalController@getExpressCheckoutSuccess');
Route::get('payments/paypal', 'PayPalController@index')->name('paypal.index');

Route::get('firebase/sw-js','AppSettingController@initFirebase');

Route::get('storage/app/public/{id}/{conversion}/{filename?}', 'UploadController@storage');

Route::middleware('auth')->group(function () {
    Route::get('clint/Baned','UserController@baned');
    Route::get('clint','UserController@index');
    Route::get('clint/create/admin','UserController@create_clinte');
    Route::post('clint/store/admin','UserController@store');
    Route::get('clint/admin/edit/{id}','UserController@edit_clinte');
    Route::delete('clinets/ban/{id}','UserController@destroy');
    Route::get('clint/{id}','UserController@showuser');
    Route::put('clinets/unban/{id}','UserController@unban');
    //freight start
    Route::get('/freight','FreightController@index');
    Route::get('/freight/order/edit/{id}','FreightController@edit');
    Route::get('/freight/order/{status}','FreightController@GetByStatus');
    Route::put('/freight/order/update/{id}','FreightController@update');
    //freight end
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::post('uploads/store', 'UploadController@store')->name('medias.create');
    Route::get('users/profile', 'UserController@profile')->name('users.profile');
    Route::post('users/remove-media', 'UserController@removeMedia');
    Route::resource('users', 'UserController');
    Route::get('allbaned/users','UserController@allbaned');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::group(['middleware' => ['permission:medias']], function () {
        Route::get('uploads/all/{collection?}', 'UploadController@all');
        Route::get('uploads/collectionsNames', 'UploadController@collectionsNames');
        Route::post('uploads/clear', 'UploadController@clear')->name('medias.delete');
        Route::get('medias', 'UploadController@index')->name('medias');
        Route::get('uploads/clear-all', 'UploadController@clearAll');
    });
    Route::group(['middleware' => ['permission:permissions.index']], function () {
        Route::get('permissions/role-has-permission', 'PermissionController@roleHasPermission');
        Route::get('permissions/refresh-permissions', 'PermissionController@refreshPermissions');
    });
    Route::group(['middleware' => ['permission:permissions.index']], function () {
        Route::post('permissions/give-permission-to-role', 'PermissionController@givePermissionToRole');
        Route::post('permissions/revoke-permission-to-role', 'PermissionController@revokePermissionToRole');
    });
    Route::group(['middleware' => ['permission:app-settings']], function () {
        Route::prefix('settings')->group(function () {
            Route::resource('permissions', 'PermissionController');
            Route::resource('roles', 'RoleController');
            Route::resource('customFields', 'CustomFieldController');
            Route::resource('currencies', 'CurrencyController')->except([
                'show'
            ]);

            Route::get('users/login-as-user/{id}', 'UserController@loginAsUser')->name('users.login-as-user');
            Route::patch('update', 'AppSettingController@update');
            Route::patch('translate', 'AppSettingController@translate');
            Route::get('sync-translation', 'AppSettingController@syncTranslation');
            Route::get('clear-cache', 'AppSettingController@clearCache');
            Route::get('check-update', 'AppSettingController@checkForUpdates');
            // disable special character and number in route params
            Route::get('/{type?}/{tab?}', 'AppSettingController@index')
                ->where('type', '[A-Za-z]*')->where('tab', '[A-Za-z]*')->name('app-settings');
        });
    });

    Route::get('car','CarController@index');
    Route::get('car/create','CarController@create');
    Route::post('car/store','CarController@store');
    Route::delete('car/{id}', 'CarController@destroy');
    Route::get('car/data/{id}','CarController@show');
    Route::post('car/update/{id}','CarController@update');

    Route::post('fields/remove-media','FieldController@removeMedia');

    Route::resource('fields', 'FieldController')->except([
        'show'
    ]);
    Route::post('markets/remove-media', 'MarketController@removeMedia');
    Route::get('requestedMarkets', 'MarketController@requestedMarkets')->name('requestedMarkets.index'); //adeed
    Route::resource('markets', 'MarketController')->except([
        'show'
    ]);
    Route::post('categories/remove-media', 'CategoryController@removeMedia'); 
    Route::resource('categories', 'CategoryController')->except([
        'show'
    ]);
    Route::resource('faqCategories', 'FaqCategoryController')->except([
        'show'
    ]);
    Route::resource('orderStatuses', 'OrderStatusController')->except([
        'create', 'store', 'destroy'
    ]);;
    Route::post('products/remove-media', 'ProductController@removeMedia');
    Route::resource('products', 'ProductController')->except([
        'show'
    ]);
    Route::post('galleries/remove-media', 'GalleryController@removeMedia');
    Route::resource('galleries', 'GalleryController')->except([
        'show'
    ]);
    Route::resource('productReviews', 'ProductReviewController')->except([
        'show'
    ]);
    Route::post('options/remove-media', 'OptionController@removeMedia');

    Route::resource('payments', 'PaymentController')->except([
        'create', 'store','edit', 'destroy'
    ]);;
    Route::resource('faqs', 'FaqController')->except([
        'show'
    ]);
    Route::resource('marketReviews', 'MarketReviewController')->except([
        'show'
    ]);
    Route::resource('favorites', 'FavoriteController')->except([
        'show'
    ]);
    Route::resource('orders', 'OrderController');
    Route::get('outbound','OrderController@outbound');

    Route::resource('notifications', 'NotificationController')->except([
        'create', 'store', 'update','edit',
    ]);;

    Route::resource('carts', 'CartController')->except([
        'show','store','create'
    ]);

    Route::resource('deliveryAddresses', 'DeliveryAddressController')->except([
        'show'
    ]);

    Route::delete('drivers/destroy/{id}', 'DriverController@destroy');
    Route::get('driver/data/{id}','DriverController@showdata');

    Route::resource('drivers', 'DriverController')->except([
        'show'
    ]);

    Route::resource('earnings', 'EarningController')->except([
        'show','edit','update'
    ]);
    Route::get('earnings/income', 'EarningController@income');
    Route::resource('driversPayouts', 'DriversPayoutController')->except([
        'show','edit','update'
    ]);

    Route::resource('marketsPayouts', 'MarketsPayoutController')->except([
        'show','edit','update'
    ]);

    Route::resource('optionGroups', 'OptionGroupController')->except([
        'show'
    ]);

    Route::post('options/remove-media','OptionController@removeMedia');

    Route::resource('options', 'OptionController')->except([
        'show'
    ]);

    Route::resource('coupons', 'CouponController')->except([
        'show'
    ]);
    Route::post('slides/remove-media','SlideController@removeMedia');
    Route::resource('slides', 'SlideController')->except([
        'show'
    ]);
    });

