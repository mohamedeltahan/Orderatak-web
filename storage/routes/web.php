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

use App\Order;

Route::get("get_api_link",function(){
   return json_encode(["link"=>"https://queen-store.net/api/"]);
});
Route::get('/', function (\Illuminate\Http\Request $request) {

  // return view("new_receipt");
   // dd(env("MAIL_DRIVER"));
   /*   $data = array('name'=>"Virat Gandhi");
   
      Mail::send("mail", $data, function($message) {
         $message->to('mohamed.ahmedfci@yahoo.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('mohamedtahan24@gmail.com','Virat Gandhi');
      });*/


   /* $location_text = "The IP address {$request->ipinfo->ip} is located in the city of {$request->ipinfo->country_name}.";
   $form=new \App\Form();
   $form->country=$request->ipinfo->country_name." : ".$request->ipinfo->city;
   $form->created_at=\Carbon\Carbon::now();
   $form->save();

   if($request->ipinfo->country_name=="Egypt"){    return view("index");
    }*/
    //return view("home");
     return redirect()->route("home");
});;


Route::get('/error_message', function (){
   return json_encode(["error"=>"Not Authenticated","code"=>401]);
})->name("error_message");
Route::group(['middleware' => ['Check_Permsission']], function () {




    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/setting', 'HomeController@setting')->name('setting');

    Route::get('admin', 'Admin\AdminController@index');
    Route::resource('admin/roles', 'Admin\RolesController');
    Route::resource('admin/permissions', 'Admin\PermissionsController');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::resource('admin/pages', 'Admin\PagesController');
    Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('admin/settings', 'Admin\SettingsController');
    Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

    Route::resource('exporters', 'Exporter\\exporterController');
    Route::resource('exports', 'Exports\\ExportsController');
    Route::resource('exporter_transactions', 'Exporter_transaction\\Exporter_transactionsController');
    Route::resource('names', 'Name\\NamesController');
    Route::resource('stores', 'Store\\StoresController');
    Route::resource('items', 'Item\\ItemsController');
    Route::resource('customers', 'Customer\\CustomersController');
    Route::resource('orders', 'Order\\OrdersController');
    Route::resource('alerts', 'Alert\\AlertsController');
    Route::resource('unavailable_alerts', 'Unavailable_alert\\Unavailable_alertsController');
    Route::resource('exports_items', 'Exports_items\\Exports_itemsController');
    Route::resource('order_items', 'Order_items\\Order_itemsController');
    Route::get("unpaid_transactions/{id}","Exporter\\exporterController@unpaid_transactions")->name("unpaid_transactions");
    Route::post("restore_item/{id}","Order\\OrdersController@restore_item")->name("restore_item");
    Route::get("print/{id}","Order\\OrdersController@print")->name("print");
    Route::get("exporter_exports/{id}","Exporter\\exporterController@exporter_exports")->name("exporter_exports");
    Route::get("replacement_create/{id}",'Order\\OrdersController@replacement_create')->name("replacement_create");
    Route::delete("delete_item/{id}","Exports\\ExportsController@delete_item")->name("delete_item");
    Route::post("replacement",'Order\\OrdersController@replacement')->name("replacement");
    Route::get("/get_permissions/{id}","Admin\UsersController@get_permission")->name("get_user_permission");
    Route::get('exports_excel', 'Exports\\ExportsController@export_to_excel')->name("exports.excel");
    Route::get('orders_excel', 'Order\\OrdersController@export_to_excel')->name("orders.excel");
    Route::get('restoreds/confirm/{id}', 'Restored\\RestoredsController@confirm')->name("confirm_restored");
    Route::get("most_paying_customers","Report\\ReportsController@most_paying_customers")->name("most_paying_customers");
    Route::get("less_paying_customers","Report\\ReportsController@less_paying_customers")->name("less_paying_customers");
    Route::get("escaped_customers","Report\\ReportsController@escaped_customers")->name("escaped_customers");
    Route::get("waiting_customers","Report\\ReportsController@waiting_customers")->name("waiting_customers");
    Route::get("most_profit_items","Report\\ReportsController@most_profit_items")->name("most_profit_items");
    Route::get("less_profit_items","Report\\ReportsController@less_profit_items")->name("less_profit_items");
    Route::get("most_sell_items","Report\\ReportsController@most_sell_items")->name("most_sell_items");
    Route::get("less_sell_items","Report\\ReportsController@less_sell_items")->name("less_sell_items");
    Route::get("most_available_items","Report\\ReportsController@most_available_items")->name("most_available_items");
    Route::get("less_available_items","Report\\ReportsController@less_available_items")->name("less_available_items");
    Route::post('exports_with_states', 'Exports\\ExportsController@exports_with_states')->name("exports_with_states");

    Route::resource('caches', 'Cache\\CachesController');

    Route::resource('restoreds', 'Restored\\RestoredsController');

    Route::resource('districts', 'District\\DistrictsController');

    Route::resource('ships', 'Ship\\ShipsController');

    Route::resource('phones', 'Phone\\PhonesController');
    Route::resource('adresses', 'Adresse\\AdressesController');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get("paymentsview","Exporter\\exporterController@payments")->name("paymentsview");

    Route::get("get_exporter_payments/{id}","Exporter\\exporterController@get_exporter_payments")->name("get_exporter_payments");
    Route::post("pay","Exporter\\exporterController@pay")->name("pay");
    Route::post('Search', 'Order\\OrdersController@Search')->name("Search");
    Route::get('order_edit_create/{id}', 'Order\\OrdersController@order_edit_create')->name("order_edit_create");
    Route::post('edit_order/{id}', 'Order\\OrdersController@edit_order')->name("edit_order");


    Route::post('get_for_ajax', 'Order\\OrdersController@get_for_ajax')->name("get_for_ajax");
    Route::get('detailed_order_items/{date}', 'Order\\OrdersController@detailed_order_items')->name("detailed_order_items");
    Route::get('orders_with_state/{state}', 'Order\\OrdersController@orders_with_state')->name("orders_with_state");
    Route::post('get_for_ajax_with_state/{date}', 'Order\\OrdersController@get_for_ajax_with_state')->name("get_for_ajax_with_state");

    Route::get('get_order_items/{id}', 'Order\\OrdersController@get_order_items')->name("get_order_items");
    Route::post('get_order_for_customer/{id}', 'Customer\\CustomersController@get_order_for_customer')->name("get_order_for_customer");

    Route::get('load_more_customers/{index}', 'Customer\\CustomersController@load_more')->name("load_more_customers");
    Route::get('search_customers}', 'Customer\\CustomersController@search')->name("search_customers");

    Route::resource('payments', 'Payment\\PaymentsController');
    Route::post('roles/store/{id}', 'Admin\RolesController@store')->name("roles.store");
    Route::get('ships/{id}/orders', 'Ship\\ShipsController@orders')->name("ship_orders");
    

Route::resource('expireds', 'Expired\\ExpiredsController');
Route::get('orders/order_details/{id}', 'Order\\OrdersController@order_details')->name("order_details");
Route::get('order_to_pdf/{id}', 'Order\\OrdersController@order_to_pdf')->name("order_to_pdf");
Route::get('deliveryman', 'Ship\\ShipsController@deliveryman_index')->name("deliveryman.index");
Route::get('shop', 'Item\\ItemsController@shop');
Route::get('online_orders', 'Order\\OrdersController@online_orders_index')->name("online_orders.index");
Route::get('accept_online_order/{id}', 'Order\\OrdersController@accept_online_order')->name("accept_online_order");


Route::post('orders/online_order', 'Order\\OrdersController@online_order_store')->name("online_orders.store");

Route::resource('ship-payments', 'ShipPayment\\ShipPaymentsController');
Route::resource('ship-districts', 'ShipDistrict\\ShipDistrictsController');
Route::get('orders_table', 'Order\\OrdersController@orders_table')->name("orders_table");
Route::get('get_all_phone_numbers', 'Phone\\PhonesController@get_all_phone_numbers')->name("get_all_phone_numbers");
Route::get('get_phone_details', 'Phone\\PhonesController@get_phone_details')->name("get_phone_details");

Route::get('get_district_cost/{id}', 'District\\DistrictsController@get_district_cost')->name("get_district_cost");




});

Auth::routes();
Route::post('forms', 'Form\\FormsController@store')->name("forms.store");

//Route::resource('forms', 'Form\\FormsController');
Route::get('forms/create', 'Form\\FormsController@create')->name("forms.create");