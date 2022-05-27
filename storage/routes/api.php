<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api',"CheckPermissionAPi"]], function () {
    
    Route::get('UserDetails', '\App\Http\Controllers\HomeController@UserDetails');
    Route::get('User/Orders', '\App\Http\Controllers\HomeController@UserOrders');
    Route::get("/user/orders/","\App\Http\Controllers\Admin\UsersController@Orders");
    Route::get("/get_user_details/{id}","\App\Http\Controllers\Admin\UsersController@get_user_details");

    
    Route::get("/orders","\App\Http\Controllers\Order\OrdersController@ApiOrders");
    Route::post("/orders","\App\Http\Controllers\Order\OrdersController@store");
    Route::put("/orders/{id}","\App\Http\Controllers\Order\OrdersController@ApiUpdate");
    Route::get("/orders/{id}","\App\Http\Controllers\Order\OrdersController@show");

    Route::post("replacement",'Order\\OrdersController@replacement');
    Route::post("restore_item/{id}","Order\\OrdersController@restore_item");
    Route::post("/orders_search","\App\Http\Controllers\Order\OrdersController@ApiSearch");

    Route::get('customers', '\App\Http\Controllers\Customer\CustomersController@index');
    Route::get('customers/{id}', '\App\Http\Controllers\Customer\CustomersController@show');

    Route::post('customers', '\App\Http\Controllers\Customer\CustomersController@store');
    Route::put('customers/{id}', '\App\Http\Controllers\Customer\CustomersController@update');
    Route::delete('customers/{id}', '\App\Http\Controllers\Customer\CustomersController@destroy');

    Route::get('customer_orders/{id}', '\App\Http\Controllers\Customer\CustomersController@ApiGetCustomerOrders');
    Route::post('customers_search', '\App\Http\Controllers\Customer\CustomersController@ApiSearch');
    Route::get('CheckIfCustomerExist/{phone}', '\App\Http\Controllers\Customer\CustomersController@CheckIfCustomerExist');

    
    Route::post("/EditOrder/{id}","\App\Http\Controllers\Order\OrdersController@edit_order");
    Route::delete("/orders/{id}","\App\Http\Controllers\Order\OrdersController@destroy");


    Route::get('names', '\App\Http\Controllers\Name\NamesController@index');
    Route::post('names', '\App\Http\Controllers\Name\NamesController@store');
    Route::get('names/{id}', '\App\Http\Controllers\Name\NamesController@show');
    Route::put('names/{id}', '\App\Http\Controllers\Name\NamesController@update');
    Route::delete('names/{id}', '\App\Http\Controllers\Name\NamesController@destroy');
    Route::get('NamesSelectList', '\App\Http\Controllers\Name\NamesController@NamesSelectList');


    Route::get('districts', '\App\Http\Controllers\District\DistrictsController@index');
    Route::post('districts', '\App\Http\Controllers\District\DistrictsController@store');
    Route::put('districts/{id}', '\App\Http\Controllers\District\DistrictsController@update');
    Route::delete('districts/{id}', '\App\Http\Controllers\District\DistrictsController@destroy');
    Route::get('search_districts', '\App\Http\Controllers\District\DistrictsController@Search');

    Route::get('items', '\App\Http\Controllers\Item\ItemsController@index');
    Route::get('GetStoreItems/{id}', '\App\Http\Controllers\Store\StoresController@GetStoreItems');
    Route::get('items/{id}', '\App\Http\Controllers\Item\ItemsController@show');
    Route::put('items/{id}', '\App\Http\Controllers\Item\ItemsController@update');
    Route::delete('items/{id}', '\App\Http\Controllers\Item\ItemsController@destroy'); 
    Route::post('items', '\App\Http\Controllers\Item\ItemsController@store');


    Route::get('exporters', '\App\Http\Controllers\Exporter\exporterController@index');
    Route::post('exporters', '\App\Http\Controllers\Exporter\exporterController@store');
    Route::put('exporters/{id}', '\App\Http\Controllers\Exporter\exporterController@update');
    Route::delete('exporters/{id}', '\App\Http\Controllers\Exporter\exporterController@destroy');
    Route::get('GetExporterExports/{id}', '\App\Http\Controllers\Exporter\exporterController@exporter_exports');
    Route::get('GetExporterAccount/{id}', '\App\Http\Controllers\Exporter\exporterController@get_exporter_payments');

    Route::get('GetUsers', 'Admin\UsersController@index');
    
    Route::post('AddNewUser', 'Admin\UsersController@AddNewUser');
    Route::put('users/{id}', 'Admin\UsersController@update');
    Route::delete('users/{id}', 'Admin\UsersController@destroy');




    Route::get('exports', '\App\Http\Controllers\Exports\ExportsController@ApiIndex');
    Route::post('exports', '\App\Http\Controllers\Exports\ExportsController@store');
    
    Route::post('EditExport/{id}', '\App\Http\Controllers\Exports\ExportsController@EditExportApi');

    
    Route::delete('exports/{id}', '\App\Http\Controllers\Exports\ExportsController@destroy');

    Route::get('exports/{id}', '\App\Http\Controllers\Exports\ExportsController@show');
    Route::post('UpdateRole/{id}', 'Admin\RolesController@store');


    Route::get('permissions', 'Admin\PermissionsController@index');
    Route::get("/AuthUserPermissions","Admin\UsersController@get_auth_user_permission");
    Route::get("/GetUserPermissions/{id}","Admin\UsersController@get_user_permission");
    Route::get("/PermissionsSelected","Admin\UsersController@get_permissions_with_auth_user_permission");
    
    Route::get('stores', '\App\Http\Controllers\Store\StoresController@index');
    Route::post('stores', '\App\Http\Controllers\Store\StoresController@store');
    Route::put('stores/{id}', '\App\Http\Controllers\Store\StoresController@update');
    Route::get('stores/{id}', '\App\Http\Controllers\Store\StoresController@show');

    Route::delete('stores/{id}', '\App\Http\Controllers\Store\StoresController@destroy');

    

    Route::get('ships', '\App\Http\Controllers\Ship\ShipsController@index');
    Route::post('ships', '\App\Http\Controllers\Ship\ShipsController@store');
    Route::put('ships/{id}', '\App\Http\Controllers\Ship\ShipsController@update');
    Route::get('ships/{id}', '\App\Http\Controllers\Ship\ShipsController@show');

    Route::delete('ships/{id}', '\App\Http\Controllers\Ship\ShipsController@destroy');
    Route::get('deliveryman', '\App\Http\Controllers\Ship\ShipsController@deliveryman_index');


    Route::get('restoreds', '\App\Http\Controllers\Restored\RestoredsController@ApiRestoreds');
    Route::post('restoreds/confirm/{id}', '\App\Http\Controllers\Restored\RestoredsController@confirm');



    Route::post('ShipDistricts', '\App\Http\Controllers\ShipDistrict\ShipDistrictsController@store');
    Route::get('ShipDistricts/{id}', '\App\Http\Controllers\ShipDistrict\ShipDistrictsController@show');
    Route::get('GetShipDistricts/{id}', '\App\Http\Controllers\ShipDistrict\ShipDistrictsController@index');
    Route::delete('ShipDistricts/{id}', '\App\Http\Controllers\ShipDistrict\ShipDistrictsController@destroy');

    Route::get('GetShipPayments/{id}', '\App\Http\Controllers\Ship\ShipsController@GetShipPayments');
    Route::post('StoreShipPayment', 'ShipPayment\\ShipPaymentsController@store');
    Route::delete('ShipPayments/{id}', 'ShipPayment\\ShipPaymentsController@destroy');

    Route::get('expireds', '\App\Http\Controllers\Expired\ExpiredsController@index');
    Route::post('expireds', '\App\Http\Controllers\Expired\ExpiredsController@store');

    Route::get("/GetItemsForOrder/{id}","\App\Http\Controllers\Order\OrdersController@GetItemsForOrderApi");

    
    Route::put('update_auth_user', 'Admin\UsersController@update_auth_user');
    Route::post('edit_profile', 'Admin\UsersController@edit_profile');

    Route::post('check_ship_district', '\App\Http\Controllers\Ship\ShipsController@Check_Ship_District');
    Route::get('get_district_ships/{id}', '\App\Http\Controllers\District\DistrictsController@get_district_ships');

    Route::post("pay","Exporter\\exporterController@pay");
    Route::get('get_homepage_permissions', 'Admin\PermissionsController@GetHomepagePermissions');
    Route::get('order_to_pdf/{id}', 'Order\\OrdersController@order_to_pdf');
    Route::get("/track_phone_orders/{phone}","\App\Http\Controllers\Order\OrdersController@track_phone_orders");

   });


   Route::get('CreateGuest', '\App\Http\Controllers\Admin\UsersController@CreateGuest');

   Route::post('login', '\App\Http\Controllers\Auth\LoginController@ApiLogin');
