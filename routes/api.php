<?php
// to remove into auth routes
Route::get('app/version','API\testAPIController@version');
Route::get('app/driver/version','API\testAPIController@version_driver');
Route::post('error','API\testAPIController@error_store');
Route::post('app/price_kilo','API\testAPIController@price_kilo');
Route::get('test','API\testAPIController@test');
Route::get('shehab','API\testAPIController@status');
Route::get('tripe/get/{id}','API\TripeAPIController@getdata');
Route::get('tripeuser/get/{id}','API\TripeAPIController@getdatauser');
Route::get('tripeuser/waiting/{id}','API\TripeAPIController@gettripuser');
Route::post('tripe/register','API\TripeAPIController@register'); 
Route::get('tripe/cancel/{id}','API\TripeAPIController@usercancel');
Route::get('tripe/end/{id}','API\TripeAPIController@userend_tripe');
Route::get('tripe/{id}/{cache_id}','API\TripeAPIController@drivercancel');
Route::get('tripe/approve/{id}/{driverid}','API\TripeAPIController@approve');
Route::post('payments/store','API\PaymentAPIController@store');
Route::post('payments/store','API\PaymentAPIController@store');
Route::post('users/update', 'API\UserAPIController@update');
Route::post('driver/car/sataus','API\Driver\UserAPIController@check_car');
Route::post('driver/car/update','API\CarAPIController@update');
Route::prefix('driver')->group(function () {
    Route::post('/login', 'API\Driver\UserAPIController@login');
    Route::post('register', 'API\Driver\UserAPIController@register');
    Route::post('upload_img', 'API\Driver\UserAPIController@register');
    Route::post('send_reset_password', 'API\Driver\UserAPIController@rest_password');
    Route::post('tripe','API\Driver\UserAPIController@getalltripe');
    Route::get('users/{id}', 'API\UserAPIController@update');
    //To remove them into Auth_api
    Route::get('logout', 'API\Driver\UserAPIController@logout');
    Route::get('settings', 'API\Driver\UserAPIController@settings');
   
    Route::post('available/{id}','API\Driver\UserAPIController@available');
    Route::post('Inbound','API\Driver\UserAPIController@Inbound');
    Route::post('user', 'API\Driver\UserAPIController@user');
       
});
//to remove it into Auth api
Route::prefix('car')->group(function () {
    Route::get('/{id}','API\CarAPIController@show');
    Route::post('/add','API\CarAPIController@store');
    Route::get('user', 'API\Driver\UserAPIController@user');
    Route::get('logout', 'API\Driver\UserAPIController@logout');
    Route::get('settings', 'API\Driver\UserAPIController@settings');

});
Route::prefix('user')->group(function (){
    Route::post('login', 'API\UserAPIController@login');
    Route::post('register', 'API\UserAPIController@register');
    Route::post('upload_img','API\UserAPIController@acconut_img');
    Route::post('send_reset_password', 'API\UserAPIController@rest_password');
    Route::post('tripe','API\UserAPIController@getalltripe');
    //To remove it into Auth Api
    Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');
    Route::post('user', 'API\UserAPIController@user');
    Route::get('logout', 'API\UserAPIController@logout');
    Route::get('settings', 'API\UserAPIController@settings');
});

Route::resource('option_groups', 'API\OptionGroupAPIController');
Route::resource('options', 'API\OptionAPIController');

Route::middleware('auth:api')->group(function () {
    Route::post('comment', 'API\CommentAPIController@store');
    Route::get('comment/{id}', 'API\CommentAPIController@allcomments');
    /*Route::grop(['middleware' => ['role:client']], function () {
        
    });*/
    Route::group(['middleware' => ['role:driver']], function () {
        Route::prefix('driver')->group(function () {
            Route::resource('orders', 'API\OrderAPIController');
            Route::resource('notifications', 'API\NotificationAPIController');
            Route::get('users/{id}', 'API\UserAPIController@update');
            Route::resource('faq_categories', 'API\FaqCategoryAPIController');
            Route::resource('faqs', 'API\FaqAPIController');
            Route::post('/verify_paper_check','API\Driver\UserAPIController@verify_paper');
        });
    });
    Route::post('users/{id}', 'API\UserAPIController@update');
    Route::resource('order_statuses', 'API\OrderStatusAPIController');
    Route::get('payments/byMonth', 'API\PaymentAPIController@byMonth')->name('payments.byMonth');
    Route::resource('payments', 'API\PaymentAPIController');

    Route::get('favorites/exist', 'API\FavoriteAPIController@exist');
    Route::resource('favorites', 'API\FavoriteAPIController');
    Route::resource('orders', 'API\OrderAPIController');
    Route::resource('product_orders', 'API\ProductOrderAPIController');
    Route::resource('notifications', 'API\NotificationAPIController');
    Route::get('carts/count', 'API\CartAPIController@count')->name('carts.count');
    Route::resource('carts', 'API\CartAPIController');

    Route::resource('delivery_addresses', 'API\DeliveryAddressAPIController');

    Route::resource('drivers', 'API\DriverAPIController');

    Route::resource('earnings', 'API\EarningAPIController');

    Route::resource('driversPayouts', 'API\DriversPayoutAPIController');

    Route::resource('marketsPayouts', 'API\MarketsPayoutAPIController');

    Route::resource('coupons', 'API\CouponAPIController')->except([
        'show'
    ]);

    Route::post('users/{id}', 'API\UserAPIController@update');
    Route::resource('payments', 'API\PaymentAPIController');
    Route::resource('earnings', 'API\EarningAPIController');
    Route::resource('driversPayouts', 'API\DriversPayoutAPIController');

    Route::resource('marketsPayouts', 'API\MarketsPayoutAPIController');

    Route::resource('coupons', 'API\CouponAPIController')->except([
        'show'
    ]);
});