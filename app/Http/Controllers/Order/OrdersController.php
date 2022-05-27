<?php

namespace App\Http\Controllers\Order;

use App\Adress;
use App\Alert;
use App\Customer;
use App\District;


use App\Exports\OrdersExport;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\Name;
use App\OnlineItem;
use App\OnlineOrder;
use App\Order;
use App\Order_item;
use App\Phone;
use App\Restored;
use App\Ship;
use App\ShipDistrict;
use App\Store;
use App\Unavailable_alert;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Types\Object_;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {


        $arr = [];
        $dates = Order::orderBy('created_at', 'DESC')->pluck("created_at");
        foreach ($dates as $date) {
            $arr[] = explode(" ", $date)[0];
        }
        $arr = array_unique($arr);


        $arr2 = [];
        foreach ($arr as $ar) {

            $arr2[] = substr($ar, 0, 7);
        }
        $arr2 = array_unique($arr2);

        $final = new Collection([]);

        $final2 = [];
        $months = [];
        $items_count = [];

        foreach ($arr2 as $month) {
            $final2 = [];
            foreach ($arr as $day) {
                $temp_count = 0;
                if (substr($day, 0, 7) == $month) {
                    $final2[$day] = Order::whereDate('created_at', "=", $day)->get(["total_price_after_discount", "id"]);
                    foreach ($final2[$day] as $order) {

                        $temp_count += $order->items()->sum("quantity");
                    }
                    $items_count[$day] = $temp_count;
                }
            }
            $months[$month] = $final2;



            /*$final=$final->merge(Order::where('created_at', ">=", $ar)->get());

            $final2[$ar]= Order::whereDate('created_at',"=", $ar)->get();
*/
        }


        /*  for ($i=0;$i<sizeof($final2);$i++){
            $final2[$i]=explode(" ",$final2[$i])[0];

        }
        $final2=array_unique($final2);*/
        /*  foreach($months["2019-11"] as $day=>$items){
            dd($day);
        }
       dd($items);
      dd($months["2019-11"]);*/
        $has_id = 0;
        $ships = Ship::where("type", "company")->get();
        $delivery_man = Ship::where("type", "person")->get();
        $districts = District::all();
        $stores = Store::all();
        $users = User::all();

        if (Order::all()->count() >= Auth::user()->no_of_orders) {
            return view('orders.index', compact("months", "final2", "arr2", "final", "has_id", "ships", "items_count", "delivery_man", "users", "districts", "stores"))->withErrors(["asdasd" => "عفوا لقد تم تجاوز الحد المسمح للاوردرات"]);
        }
        else if(sizeof($dates)==0){
            return view('orders.index', compact("months" ,"final2", "arr2", "final", "has_id", "ships", "items_count", "delivery_man", "users", "districts", "stores"))->withErrors(["asdasd" => "عفوا لم تم يتم تسجيل اي اوردر حتي الان"]);
     
        }




        return view('orders.index', compact("months", "final2", "arr2", "final", "has_id", "ships", "items_count", "delivery_man", "users", "districts", "stores"));

        /*
        $orders = Order::orderBy('created_at', 'desc')->get();
        $tempMonthYear =0;
        $tempDay = 0;

        //This temp export is added in order to loop through all the orders.
        $temp_order=new Order();
        $temp_order->created_at=Carbon::create(2018);
        $orders->push($temp_order);
        $size = count($orders);
        return view('orders.index', compact('orders',"size","tempMonthYear","tempDay","has_id","ships"));*/
    }

    public function ApiOrders(Request $request)
    {

        file_put_contents("order.txt", json_encode($request->all()));

        try {
            $from = date('Y-m-d H:i:s', strtotime($request->from));
            $to = date('Y-m-d H:i:s', strtotime($request->to));
            //  $from=$request->from;
            //$to=$request->to;
            //   return $from;
            //      $from=Carbon::now()->subDays(2);
            //     $to=Carbon::now();

            file_put_contents("aaa.txt", $from);
            file_put_contents("bbb.txt", $to);

            $state = $request->state;
            $ship_id = $request->ship_id;
            $collected = $request->collected;
            $completed = $request->completed;

            if ($from != null && $to != null) {
                $orders = Order::where("created_at", ">=", $from)->where("created_at", "<=", $to);
            }
            if ($state != null) {
                $orders = $orders->where("state", $state);
            }
            if ($ship_id != null) {
                $orders = $orders->where("ship_id", $ship_id);
            }
            if ($collected != null) {
                $orders = $orders->where("collected", $collected);
            }
            if ($completed != null) {
                $orders = $orders->where("completed", $completed);
            }
            //$orders=$orders->paginate()->toJson();
            $orders = json_decode($orders->paginate()->toJson(), true);
            $temp_arr = [];
            foreach ($orders["data"] as $order) {
                $ship_districts_ids = ShipDistrict::where("district_id", $order["district_id"])->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order["ship_id"])->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order["district_id"])->first()->cost;
                }

                $order["shippers"] = $ship;
                if ($order["ship_id"] != null && ShipDistrict::where("ship_id", $order["ship_id"])->where("district_id", $order["district_id"])->first() != null) {
                    $temp = Ship::find($order["ship_id"]);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order["district_id"])->first()->cost;
                    if ($temp != null) {
                        $order["shippers"]->prepend($temp);
                    }
                }


                $order["ship"] = Ship::find($order["ship_id"]);
                $order["customer"] = Customer::find($order["customer_id"]);
                $order["phones"] = Phone::where("customer_id", $order["customer_id"])->pluck("phone");
                $temp_arr[] = $order;
            }
            $orders["data"] = $temp_arr;

            file_put_contents("ordes.txt", json_encode($orders));

            return json_encode(["data" => ["orders" => $orders], "code" => 200, "photo_link" => "https://orderatak.com/system/public_html/help_photos/orders.jpg", "video_link" => "https://www.youtube.com/watch?v=50ttf6SfkTE"], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return $th->getMessage();
            file_put_contents("errors.txt", json_encode($th->getMessage()));

            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {  //$start = microtime(true);
        $stores = Store::all();
        $all_items = [];

        foreach ($stores as $store) {
            $items = Item::where("store_id", $store->id)->get();
            foreach ($items as $item) {
                $item->group = $item->name->name;
                $item->color = $item->name->color;
            }
            $items = $items->groupBy("group");
            foreach ($items as $key => $value) {
                $items[$key] = $value->groupBy("color");
            }
            $all_items[$store->id] = $items;
        }
        //dd($all_items);


        $customers = Customer::all();
        $names_id = Item::all()->pluck("name_id")->unique();
        $names = [];
        /*foreach ($names_id as $name_id){
            $names[]=Name::where("id",$name_id)->first()->name;

        }*/
        $names = Name::all()->pluck("name")->unique();
        $districts = District::all();
        // $time_elapsed_secs = microtime(true) - $start;


        return view('orders.create', compact("all_items", "customers", "names", "districts"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $now = Carbon::now();

        if (Order::whereYear('created_at', '=', $now->year)->whereMonth('created_at', '=', $now->month)->count() >= Auth::user()->no_of_orders || ($request->customer_id == 0 && Customer::whereYear('created_at', '=', $now->year)->whereMonth('created_at', '=', $now->month)->count() >= Auth::user()->no_of_customers)) {
            if (str_contains(url()->current(), 'api')) {
                return json_encode(["code" => 500, "message" => "لقد تم تجاوز عدد الاوردرات المسموح"], JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back();
        }

        try {
            $cust_phone=Phone::where("phone",$request->phone)->first();
            if ($cust_phone!=null) {
            
              $request->merge(["customer_id"=>$cust_phone->customer_id]);
                
            }
            else{
              $request->merge(["customer_id"=>0]);
            }



            $order = new Order();
            //to start the policies from the user have already arrive
            if (Order::max("policy_id") == null) {
                $order->policy_id = Auth::user()->policy_id;
            } else {
                $order->policy_id = Order::max("policy_id") + 1;
            }

            $order->total_price_before_discount = $request->total_price_after_discount + $request->discount;
            $order->total_price_after_discount = $request->total_price_after_discount;
            $order->discount = $request->discount;
            $order->district_id = $request->district_id;
            if ($request->filled("ship_id")) {
                $order->ship_id = $request->ship_id;
            }

            $order->no_of_items = sizeof($request->items_id);
            if ($request->exists("details")) {
                $order->details = $request->details;
            }
            $order->receiving_date = $request->receiving_date;
            $order->ordering_date = Carbon::now()->toDateString();
            $customer = new Customer();
            if ($request->customer_id == 0) {
                $customer->name = $request->name;
                $customer->governorate = $request->governorate;

                $customer->customer_platform = $request->customer_platform;
                $customer->customer_link = $request->customer_link;
                $customer->type = "عادي";

                $customer->save();
                $phone_array = explode("-", $request->phone);



                foreach ($phone_array as $phone) {
                    $p = new Phone();
                    $p->phone = $phone;
                    $customer->phones()->save($p);
                }

                //  foreach ($request->address as $addres){
                $a = new Adress();
                $a->address = $request->address;
                $customer->addresses()->save($a);

                //   }
            } else {
                $customer = Customer::find($request->customer_id);
            }
            $order->customer_id = $customer->id;
            if ($request->delivery_cost != 0) {
                $order->delivery = $request->delivery_cost;
            } else {
                $order->delivery = 0;
            }
            // $order->ship_id=DB::table("ships")->first()->id;
            $phone_array = explode("-", $request->phone);

            foreach ($phone_array as $phone) {
                if (Phone::where("customer_id", $customer->id)->where("phone", $phone)->first() == null) {
                    $p = new Phone();
                    $p->phone = $phone;
                    $customer->phones()->save($p);
                }
            }
            if (Adress::where("customer_id", $customer->id)->where("address", $request->address)->first() == null) {
                $a = new Adress();
                $a->address = $request->address;
                $customer->addresses()->save($a);
            }

            $order->receiving_address = $request->address;
            $order->user_id = Auth::user()->id;


            $order->completed = 1;
            $order->type = "جديد";
            $order->state = "انتظار";

            $order->save();
            $array_size = sizeof($request->items_id);
            $ids_array = $request->items_id;
            $quantity_array = $request->quantity;


            for ($i = 0; $i < $array_size; $i++) {
                $item = Item::find($ids_array[$i]);
                /*  if($item->quantity==0){
                    $unavaialble_alert=new Unavailable_alert();
                    $unavaialble_alert->order_id=$order->id;
                    $unavaialble_alert->name_id=$item->name_id;
                    $unavaialble_alert->size=$item->size;
    
                    $unavaialble_alert->state="not_seen";
                    $unavaialble_alert->user_id=Auth::user()->id;
                    $unavaialble_alert->save();
                    $order->completed=false;
                    $order->save();
    
                }
                else*/
                /* {
                    $quantity = $quantity_array[$i];
                    $order_item = new Order_item();
                    $order_item->name_id = $item->name_id;
                    $order_item->selling_price = $item->selling_price;
                    $order_item->buying_price = $item->buying_price;
                    $order_item->discount = $item->discount;
                    $order_item->size = $item->size;
                    $order_item->quantity = $quantity;
                    $order->items()->save($order_item);
                    if($item->quantity>$quantity){$item->quantity=$item->quantity-$quantity;
    
                        if($item->quantity<=5 && Alert::where("item_id",$item->id)->first()==null)
                        {
                            foreach ($users as $user_id) {
                                $alert = new Alert();
                                $alert->item_id = $item->id;
                                $alert->state = "not_seen";
                                $alert->user_id = $user_id;
                                $alert->save();
                            }
    
                        }
                    }
                    else{$item->quantity=0;}
                    $item->save();
                }*/ {
                    $quantity = $quantity_array[$i];
                    $order_item = new Order_item();
                    $order_item->name_id = $item->name_id;
                    $order_item->selling_price = $item->selling_price;
                    if ($item->quantity == 0) {
                        $order_item->selling_price = 0;
                        $order->state = "غير متوفر";
                        $order->save();
                    }
                    $order_item->buying_price = $item->buying_price;
                    $order_item->discount = $item->discount;
                    $order_item->size = $item->size;
                    $order_item->quantity = $quantity;
                    //   return $order_item;

                    $order->items()->save($order_item);
                    if ($item->quantity > $quantity) {
                        $item->quantity = $item->quantity - $quantity;

                        if ($item->quantity <= 5 && Alert::where("item_id", $item->id)->first() == null) {
                            foreach ($users as $user_id) {
                                $alert = new Alert();
                                $alert->item_id = $item->id;
                                $alert->state = "not_seen";
                                $alert->user_id = $user_id;
                                $alert->save();
                            }
                        }
                    } else {
                        $item->quantity = 0;
                    }
                    $item->save();
                }
            }
            if (str_contains(url()->current(), 'api')) {
                $returned_obj = [];
                $returned_obj["order"] = $order;
                $returned_obj["order_items"] = $order->items;
                return json_encode(["data" => $returned_obj, "code" => 200], JSON_UNESCAPED_UNICODE);
            }
            return redirect('orders')->with('flash_message', 'Order added!');
        } catch (\Throwable $th) {
            if (str_contains(url()->current(), 'api')) {
                return $th->getMessage();
                return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->ship = Ship::find($order->ship_id);
            $order->customer = Customer::find($order->customer_id);
            $order->phones = Phone::where("customer_id", $order->customer_id)->pluck("phone");
            $order_items = Order_item::where("order_id", $id)->get();
            $temp_items = [];
            foreach ($order_items as $item) {
                $item->name = Name::find($item->name_id);
                $temp_items[] = $item;
            }
            return json_encode(["data" => ["order" => $order, "order_items" => $temp_items], "code" => 200, "photo_link" => "https://orderatak.com/system/public_html/help_photos/orders.jpg", "video_link" => "https://www.youtube.com/watch?v=50ttf6SfkTE"], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني", "error" => $th->getMessage()], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $order = Order::findOrFail($id);
            if (str_contains(url()->current(), 'api')) {
                $returned_obj = [];
                $returned_obj["order"] = $order;
                return json_encode(["data" => $order, "code" => 200], JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back();
        } catch (\Throwable $th) {

            if (str_contains(url()->current(), 'api')) {
                return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */


    public function update(Request $request, $id)
    {


        $requestData = $request->all();

        $order = Order::findOrFail($id);

        if ($request->has("collected")) {
            $order = Order::find($id);
            $order->collected = $request->collected;
            $order->save();
            return "1";
        }

        if (Order::find($id)->state != "مرتجع" && $request->state == "مرتجع") {
            $items = Order::find($id)->items;
            foreach ($items as $item) {
                $restored = new Restored();
                $restored->name_id = $item->name_id;
                $restored->order_id = $item->order_id;
                $restored->ship_id = $order->ship_id;

                $restored->user_id = Auth::user()->id;
                $restored->size = $item->size;
                $restored->quantity = $item->quantity;
                $restored->store_id = $request->store_id;
                $restored->reason = $request->reason;
                if ($request->received == 0) {
                    $restored->confirmed = 0;
                } else {
                    $quantity = DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->where("store_id", $request->store_id)->first()->quantity;

                    DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->where("store_id", $request->store_id)->update(["quantity" => $item->quantity + $quantity]);

                    $restored->confirmed = 1;
                }
                $restored->save();


                $order->total_price_after_discount = $request->new_cost;
                $order->state = "مرتجع";


                $order->no_of_items = 0;
                //delete it from order if all restored
                Order_item::destroy($item->id);
            }
        }

        if (Order::find($id)->state != "لم يتم التاكيد" && $request->state == "لم يتم التاكيد") {
            $items = Order::find($id)->items;
            foreach ($items as $item) {
                $quantity = DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->first()->quantity;

                DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->update(["quantity" => $item->quantity + $quantity]);
            }
        }
        if (Order::find($id)->state == "لم يتم التاكيد" && $request->state != "لم يتم التاكيد") {
            $items = Order::find($id)->items;
            foreach ($items as $item) {
                $quantity = DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->first()->quantity;

                DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->update(["quantity" => $quantity - $item->quantity]);
            }
        }

        if ($request->has("discount")) {
            $requestData["total_price_after_discount"] = $order->total_price_before_discount - $request->discount + $order->delivery;
            $order->update($requestData);
        }
        if ($request->filled("district_id")) {

            if ($request->district_id != null) {
                if (ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $request->district_id)->first() != null) {
                    $requestData["ship_districts_id"] = ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $request->district_id)->first()->id;
                     if($request->filled("delivery")){

                    $requestData["total_price_after_discount"] = $order->total_price() + $requestData["delivery"] - $order->discount;
                    
                     }
                     else{
                       $requestData["total_price_after_discount"] = $order->total_price() + ShipDistrict::where("ship_id", $request->ship_id)->where("district_id", $order->district_id)->first()->cost- $order->discount;
                                                 $requestData["delivery"]=ShipDistrict::where("ship_id", $request->ship_id)->where("district_id", $order->district_id)->first()->cost;


                    }
                }
            }


            $order->update($requestData);
            return "1";
        }
        if ($request->filled("ship_id")) {

            if ($request->ship_id != null) {
                if (ShipDistrict::where("ship_id", $request->ship_id)->where("district_id", $order->district_id)->first() != null) {
                    $requestData["ship_districts_id"] = ShipDistrict::where("ship_id", $request->ship_id)->where("district_id", $order->district_id)->first()->id;
                    if($request->filled("delivery")){
                    $requestData["total_price_after_discount"] = $order->total_price() + $requestData["delivery"] - $order->discount;
                    }
                    else{
                       $requestData["total_price_after_discount"] = $order->total_price() + ShipDistrict::where("ship_id", $request->ship_id)->where("district_id", $order->district_id)->first()->cost- $order->discount;
                          $requestData["delivery"]=ShipDistrict::where("ship_id", $request->ship_id)->where("district_id", $order->district_id)->first()->cost;
                    }
                }
            }
        }

        $order->update($requestData);
        return "1";




        //  return redirect('orders')->with('flash_message', 'Order updated!');
    }

    public function ApiUpdate(Request $request, $id)
    {
        try {

            $requestData = $request->all();

            $order = Order::findOrFail($id);
            if ($request->has("collected")) {
                $order = Order::find($id);
                $order->collected = $request->collected;
                $order->save();
                $order=Order::find($id);

                $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order->ship_id)->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order->district_id)->first()->cost;
                }

                $order->shippers = $ship;
                if ($order->ship_id != null && ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $order->district_id)->first() != null) {
                    $temp = Ship::find($order->ship_id);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order->district_id)->first()->cost;
                    if ($temp != null) {
                        $order->shippers->prepend($temp);
                    }
                }


                $order->ship = Ship::find($order->ship_id);

                $order->customer = Customer::find($order["customer_id"]);
                $order->phones = Phone::where("customer_id", $order["customer_id"])->pluck("phone");

                return json_encode(["data" => ["order" => $order],"code" => 200], JSON_UNESCAPED_UNICODE);
            }

            if (Order::find($id)->state != "مرتجع" && $request->state == "مرتجع") {
                $items = Order::find($id)->items;
                foreach ($items as $item) {
                    $restored = new Restored();
                    $restored->name_id = $item->name_id;
                    $restored->order_id = $item->order_id;
                    $restored->ship_id = $order->ship_id;

                    $restored->user_id = Auth::user()->id;
                    $restored->size = $item->size;
                    $restored->quantity = $item->quantity;
                    $restored->store_id = $request->store_id;
                    $restored->reason = $request->reason;
                    if ($request->received == 0) {
                        $restored->confirmed = 0;
                    } else {
                        $quantity = DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->where("store_id", $request->store_id)->first()->quantity;

                        DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->where("store_id", $request->store_id)->update(["quantity" => $item->quantity + $quantity]);

                        $restored->confirmed = 1;
                    }
                    $restored->save();


                    $order->total_price_after_discount = $request->new_cost;
                    $order->state = "مرتجع";


                    $order->no_of_items = 0;
                    //delete it from order if all restored
                    Order_item::destroy($item->id);
                }
                $order->update($requestData);
                $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order->ship_id)->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order->district_id)->first()->cost;
                }

                $order->shippers = $ship;
                if ($order->ship_id != null && ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $order->district_id)->first() != null) {
                    $temp = Ship::find($order->ship_id);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order->district_id)->first()->cost;
                    if ($temp != null) {
                        $order->shippers->prepend($temp);
                    }
                }


                $order->ship = Ship::find($order->ship_id);

                return json_encode(["data" => ["order" => $order],"code" => 200], JSON_UNESCAPED_UNICODE);
            }

            if (Order::find($id)->state != "لم يتم التاكيد" && $request->state == "لم يتم التاكيد") {
                $items = Order::find($id)->items;
                foreach ($items as $item) {
                    $quantity = DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->first()->quantity;

                    DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->update(["quantity" => $item->quantity + $quantity]);
                }
                $order->update($requestData);

                $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order->ship_id)->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order->district_id)->first()->cost;
                }

                $order->shippers = $ship;
                if ($order->ship_id != null && ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $order->district_id)->first() != null) {
                    $temp = Ship::find($order->ship_id);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order->district_id)->first()->cost;
                    if ($temp != null) {
                        $order->shippers->prepend($temp);
                    }
                }


                $order->ship = Ship::find($order->ship_id);
                return json_encode(["data" => ["order" => $order ],"code" => 200], JSON_UNESCAPED_UNICODE);
            }
            if (Order::find($id)->state == "لم يتم التاكيد" && $request->state != "لم يتم التاكيد") {
                $items = Order::find($id)->items;
                foreach ($items as $item) {
                    $quantity = DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->first()->quantity;

                    DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->update(["quantity" => $quantity - $item->quantity]);
                }
                $order->update($requestData);

                $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order->ship_id)->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order->district_id)->first()->cost;
                }

                $order->shippers = $ship;
                if ($order->ship_id != null && ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $order->district_id)->first() != null) {
                    $temp = Ship::find($order->ship_id);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order->district_id)->first()->cost;
                    if ($temp != null) {
                        $order->shippers->prepend($temp);
                    }
                }


                $order->ship = Ship::find($order->ship_id);

                return json_encode(["data" => ["order" => $order ],"code" => 200], JSON_UNESCAPED_UNICODE);
            }

            if ($request->has("discount")) {
                $requestData["total_price_after_discount"] = $order->total_price_before_discount - $request->discount + $order->delivery;
                $order->update($requestData);

                $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order->ship_id)->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order->district_id)->first()->cost;
                }

                $order->shippers = $ship;
                if ($order->ship_id != null && ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $order->district_id)->first() != null) {
                    $temp = Ship::find($order->ship_id);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order->district_id)->first()->cost;
                    if ($temp != null) {
                        $order->shippers->prepend($temp);
                    }
                }


                $order->ship = Ship::find($order->ship_id);
                return json_encode(["data" => ["order" => $order],"code" => 200], JSON_UNESCAPED_UNICODE);
            }
            if ($request->filled("district_id")) {

                if ($request->district_id != null) {
                    if (ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $request->district_id)->first() != null) {
                        $requestData["ship_districts_id"] = ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $request->district_id)->first()->id;
                        $requestData["delivery"] = ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $request->district_id)->first()->cost;
                        $requestData["total_price_after_discount"] = $order->total_price() + $requestData["delivery"] - $order->discount;
                    }
                }


                $order->update($requestData);

                $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order->ship_id)->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order->district_id)->first()->cost;
                }

                $order->shippers = $ship;
                if ($order->ship_id != null && ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $order->district_id)->first() != null) {
                    $temp = Ship::find($order->ship_id);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order->district_id)->first()->cost;
                    if ($temp != null) {
                        $order->shippers->prepend($temp);
                    }
                }


                $order->ship = Ship::find($order->ship_id);
                return json_encode(["data" => ["order" => $order],"code" => 200], JSON_UNESCAPED_UNICODE);
            }
            if ($request->filled("ship_id")) {

                if ($request->ship_id != null) {
                    if (ShipDistrict::where("ship_id", $request->ship_id)->where("district_id", $order->district_id) != null) {
                        $requestData["ship_districts_id"] = ShipDistrict::where("ship_id", $request->ship_id)->where("district_id", $order->district_id)->first()->id;
                        $requestData["delivery"] = ShipDistrict::where("ship_id", $request->ship_id)->where("district_id", $order->district_id)->first()->cost;
                        $requestData["total_price_after_discount"] = $order->total_price() + $requestData["delivery"] - $order->discount;
                    }
                }

                $order->update($requestData);

                $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order->ship_id)->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order->district_id)->first()->cost;
                }

                $order->shippers = $ship;
                if ($order->ship_id != null && ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $order->district_id)->first() != null) {
                    $temp = Ship::find($order->ship_id);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order->district_id)->first()->cost;
                    if ($temp != null) {
                        $order->shippers->prepend($temp);
                    }
                }


                $order->ship = Ship::find($order->ship_id);
                return json_encode(["data" => ["order" => $order],"code" => 200], JSON_UNESCAPED_UNICODE);
            }

            $order->update($requestData);

            $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
            $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order->ship_id)->get();
            foreach ($ship as $man) {
                $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order->district_id)->first()->cost;
            }

            $order->shippers = $ship;
            if ($order->ship_id != null && ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $order->district_id)->first() != null) {
                $temp = Ship::find($order->ship_id);
                $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order->district_id)->first()->cost;
                if ($temp != null) {
                    $order->shippers->prepend($temp);
                }
            }


            $order->ship = Ship::find($order->ship_id);
            return json_encode(["data" => ["order" => $order],"code" => 200], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {

            $order = Order::find($id);
            foreach ($order->items as $item) {
                $quantity = DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->first()->quantity;
                DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->update(["quantity" => $item->quantity + $quantity]);
            }


            Order::destroy($id);

            if (str_contains(url()->current(), 'api')) {
                $returned_obj = [];
                $returned_obj["state"] = 1;
                return json_encode(["data" => $returned_obj, "code" => 200], JSON_UNESCAPED_UNICODE);
            }


            return redirect('orders');
        } catch (\Throwable $th) {
            return redirect('orders');
        }
    }
    public function restore_item(Request $request, $id)
    {
        try {
            $item = Order_item::find($id);

            $restored = new Restored();
            if (str_contains(url()->current(), 'api')) {
                if (Order::find($item->order_id)->ship_id == null) {
                    return json_encode(["code" => 500, "message" => "لم يتم تسليم الاوردر لشركة شحن بالفعل"], JSON_UNESCAPED_UNICODE);
                }
            }
            $restored->ship_id = Ship::find(Order::find($item->order_id)->ship_id)->id;

            $restored->name_id = $item->name_id;
            $restored->order_id = $item->order_id;
            $restored->user_id = Auth::user()->id;
            $restored->size = $item->size;
            $restored->store_id = $request->store_id;

            $restored->reason = $request->reason;
            if ($request->received == 0) {
                $restored->quantity = $request->quantity;
                $restored->confirmed = 0;
            } else {
                $restored->quantity = $request->quantity;
                $restored->confirmed = 1;
            }
            $restored->save();

            $order = Order::find($item->order_id);

            $restored_quantity = $request->quantity;


            $order->total_price_after_discount = $order->total_price_after_discount - ($item->selling_price * $restored_quantity) - $order->delivery;
            $order->state = "مرتجع جزئي";
            if ($request->quantity == $item->quantity) {
                $order->no_of_items = $order->no_of_items - 1;
                //delete it from order if all restored
                Order_item::destroy($id);
            } else {
                $item->quantity = $item->quantity - $restored_quantity;
                $item->save();
            }
            if ($request->received == 1) {
                if (Item::where("name_id", $item->name_id)->where("size", $item->size)->first() != null) {
                    $this_item_quantity = Item::where("name_id", $item->name_id)->where("size", $item->size)->first()->quantity;
                    Item::where("name_id", $item->name_id)->where("size", $item->size)->update(["quantity" => $restored_quantity + $this_item_quantity]);
                }
                else{
                    $temp=new Item();
                    $temp->name_id=$item->name_id;
                    $temp->quantity=$request->quantity;
                    $temp->size=$item->size;
                    $temp->buying_price=$item->buying_price;
                    $temp->selling_price=$item->selling_price;
                    $temp->discount=$item->discount;
                    $temp->store_id=$request->store_id;
                    $temp->save();
 
                }
            }

            $order->save();
            if (str_contains(url()->current(), 'api')) {
                $returned_obj = [];
                $returned_obj["order"] = $order;
                $returned_obj["items"] = $order->items;
                return json_encode(["data" => $returned_obj, "code" => 200], JSON_UNESCAPED_UNICODE);
            }
            return redirect()->route("orders.index");
        } catch (\Throwable $th) {
            if (str_contains(url()->current(), 'api')) {
                return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني", "error" => $th->getMessage()], JSON_UNESCAPED_UNICODE);
            }
            return redirect()->route("orders.index");
        }
    }

    public function replacement_create($id)
    {
         $stores = Store::all();
        $all_items = [];

        foreach ($stores as $store) {
            $items = Item::where("store_id", $store->id)->get();
            foreach ($items as $item) {
                $item->group = $item->name->name;
                $item->color = $item->name->color;
            }
            $items = $items->groupBy("group");
            foreach ($items as $key => $value) {
                $items[$key] = $value->groupBy("color");
            }
            $all_items[$store->id] = $items;
        }
        
        $order_item = Order_item::find($id);

        $order = Order::find($order_item->order_id);

        $customers = Customer::all();
        $names_id = Item::all()->pluck("name_id")->unique();
        $names = [];
        
        $names = Name::all()->pluck("name")->unique();
        $districts = District::all();

        $order_items = $order->items;
        foreach ($order_items as $i) {
            $i->main_item_id = Item::where("size", $i->size)->where("name_id", $i->name_id)->first()->id;
        }
        $customer = Customer::find($order->customer_id);




        return view("orders.replacement", compact("order_item", "order", "customer", "items", "names", "districts","all_items","order_items"));
    }

    public function replacement(Request $request)
    {

        try {
            $item = Order_item::find($request->item_id);
            $restored = new Restored();
            $restored->name_id = $item->name_id;
            $restored->order_id = $item->order_id;
            $restored->user_id = Auth::user()->id;
            $restored->store_id = $request->store_id;
            $restored->ship_id = Order::find($item->order_id)->ship_id;
            $restored->size = $item->size;
            if ($request->received == 0) {
                $restored->quantity = $request->restored_quantity;
                $restored->confirmed = 0;
            } else {
                $restored->quantity = $request->restored_quantity;
                $restored->confirmed = 1;
            }
            $restored->save();

            $order = Order::find($item->order_id);
            $restored_quantity = $request->restored_quantity;


            if ($request->exists("details")) {
                $order->details = $request->details;
            }


            $order->prev_total = $order->total_price_after_discount;
            $order->discount = $request->discount;
            $order->type = "استبدال";


            if ($restored_quantity == $item->quantity) {
                Order_item::destroy($request->item_id);

                $order->no_of_items = ($order->no_of_items - 1) + sizeof($request->items_id);
            } else {
                $item->quantity = $item->quantity - $restored_quantity;
                $item->save();
            }

            $order->created_at = Carbon::now();
            $order->save();
            if ($request->received == 1) {
                $this_item_quantity = Item::where("name_id", $item->name_id)->where("size", $item->size)->first()->quantity;
                Item::where("name_id", $item->name_id)->where("size", $item->size)->update(["quantity" => $restored_quantity + $this_item_quantity]);
            }
            $array_size = sizeof($request->items_id);
            $ids_array = $request->items_id;
            $quantity_array = $request->quantity;

            for ($i = 0; $i < $array_size; $i++) {
                $item = Item::find($ids_array[$i]);
                if ($item->quantity == 0) {
                    $unavaialble_alert = new Unavailable_alert();
                    $unavaialble_alert->order_id = $order->id;
                    $unavaialble_alert->name_id = $item->name_id;
                    $unavaialble_alert->size = $item->size;

                    $unavaialble_alert->state = "not_seen";
                    $unavaialble_alert->user_id = Auth::user()->id;
                    $unavaialble_alert->save();
                    $order->completed = 0;
                    $order->save();
                } else {
                    $quantity = $quantity_array[$i];
                    $order_item = new Order_item();
                    $order_item->name_id = $item->name_id;
                    $order_item->selling_price = $item->selling_price;
                    $order_item->buying_price = $item->buying_price;
                    $order_item->discount = $item->discount;
                    $order_item->size = $item->size;
                    $order_item->quantity = $quantity;
                    $order->items()->save($order_item);
                }
            }
             $order->total_price_after_discount= $order->total_price() + $order->delivery - $order->discount;
             $order->save();


            if (str_contains(url()->current(), 'api')) {
                $returned_obj = [];
                $returned_obj["order"] = $order;
                $returned_obj["order_items"] = $order->items;
                return json_encode(["data" => $returned_obj, "code" => 200], JSON_UNESCAPED_UNICODE);
            }

            return redirect()->route("orders.index");
        } catch (\Throwable $th) {
            dd($th->getMessage());
            if (str_contains(url()->current(), 'api')) {
                
                return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
            }
            return redirect()->route("orders.index");
        }
    }
    public function print($id)
    {
        $order = Order::find($id);
        return view(Auth::user()->receipt_name, compact("order"));
    }
    public function export_to_excel(Request $request)
    {

        $from = date($request->start);
        $to = date($request->end);
        $state = $request->state;
        $ship_id = $request->ship_id;

        try {
            return Excel::download(new OrdersExport($from, $to, $ship_id, $state), 'فواتير.xlsx');
        } catch (\Exception $e) {
            dd($e->getMessage());

            return redirect()->back();
        }
    }
    public function get_for_ajax(Request $request)
    {
        $orders = null;
        if ($request->has("ship_id")) {
            $orders = Order::where("ship_id", $request->ship_id)->whereDate("created_at", "=", $request->date)->get();
        } else {
            $orders = Order::whereDate("created_at", "=", $request->date)->get();
        }
        foreach ($orders as $order) {
            
            $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
            $shippers = Ship::where("type","person")->whereIn("id", $ship_districts_ids)->get();
            $companies = Ship::where("type","company")->whereIn("id", $ship_districts_ids)->get();

            $order->shippers=$shippers;
            $order->companies=$companies;
            $order->no_of_items = $order->no_of_items();
            $order->customer_name = $order->customer->name;
            $order->username = $order->user->name;
            $order->hour = $order->hour();

            $order->link = route("print", $order->id);
            $order->edit_link = route("order_edit_create", $order->id);
            $order->destroy_link = route("orders.destroy", $order->id);
        }
        return $orders;
    }
    public function get_for_ajax_with_state(Request $request, $state)
    {
        $orders = null;
        if ($request->has("ship_id")) {
            $orders = Order::where("ship_id", $request->ship_id)->where("state", $state)->whereDate("created_at", "=", $request->date)->get();
        } else {
            $orders = Order::where("state", $state)->whereDate("created_at", "=", $request->date)->get();
        }
        foreach ($orders as $order) {
            $order->no_of_items = $order->no_of_items();
            $order->customer_name = $order->customer->name;
            $order->username = $order->user->name;
            $order->hour = $order->hour();

            $order->link = route("print", $order->id);
            $order->edit_link = route("order_edit_create", $order->id);

            $order->destroy_link = route("orders.destroy", $order->id);
        }
        return $orders;
    }
    public function get_order_items($id)
    {
        $order=Order::find($id);
        $items = Order::find($id)->items;
        foreach ($items as $item) {

            $item->name = $item->name->name;
            $item->state=$order->state;
        }
        
          return $items;
    }
    public function detailed_order_items(Request $request, $date)
    {
        $orders = null;
        if ($request->has("ship_id")) {
            $orders = Order::where("ship_id", $request->ship_id)->whereDate('created_at', "=", $date)->pluck("id");
        } else {
            $orders = Order::whereDate('created_at', "=", $date)->pluck("id");
        }

        $items = new Collection();
        $ids = [];
        $item_ids = [];
        $names = name::all();
        foreach ($orders as $order_id) {
            $items = $items->merge(Order_item::where("order_id", $order_id)->get());
        }
        $sizes = $items->unique("size")->pluck("size");
        $temp_sizes = [];
        foreach ($sizes as $key => $size) {
            $sizes[$size] = 0;
            unset($sizes[$key]);
        }
        $last_arr = [];
        $items = $items->groupBy("name_id");

        //dd($items);
        foreach ($items as $key => $value) {

            foreach ($sizes as $ke => $size) {
                $temp_sizes[$ke] = 0;
            }


            foreach ($value as $v) {
                $temp_sizes[$v->size] = $temp_sizes[$v->size] + $v->quantity;
            }
            $last_arr[Name::find($key)->name . " : " . Name::find($key)->code . " : " . Name::find($key)->color] = $temp_sizes;
        }

        return view("detailed_order", compact("last_arr", "date"));
    }
    public function orders_with_state(Request $request, $state)
    {
        //to test
        //  dd($request->ship_id);
        $dates = null;
        if ($request->has("ship_id")) {
            $dates = Order::where("ship_id", $request->ship_id)->where("state", $state)->orderBy('created_at', 'DESC')->pluck("created_at");
        } else {
            $dates = Order::where("state", $state)->orderBy('created_at', 'DESC')->pluck("created_at");
        }
        $arr = [];
        foreach ($dates as $date) {
            $arr[] = explode(" ", $date)[0];
        }
        $arr = array_unique($arr);


        $arr2 = [];
        foreach ($arr as $ar) {

            $arr2[] = substr($ar, 0, 7);
        }
        $arr2 = array_unique($arr2);

        $final = new Collection([]);

        $final2 = [];
        $months = [];
        $items_count = [];

        foreach ($arr2 as $month) {
            $final2 = [];
            foreach ($arr as $day) {
                $temp_count = 0;
                if (substr($day, 0, 7) == $month) {
                    if ($request->has("ship_id")) {
                        $final2[$day] = Order::where("ship_id", $request->ship_id)->where("state", $state)->whereDate('created_at', "=", $day)->get(["total_price_after_discount", "id"]);
                    } else {
                        $final2[$day] = Order::where("state", $state)->whereDate('created_at', "=", $day)->get(["total_price_after_discount", "id"]);
                    }
                    foreach ($final2[$day] as $order) {

                        $temp_count += $order->items()->sum("quantity");
                    }
                    $items_count[$day] = $temp_count;
                }
            }
            $months[$month] = $final2;



            /*$final=$final->merge(Order::where('created_at', ">=", $ar)->get());

            $final2[$ar]= Order::whereDate('created_at',"=", $ar)->get();
*/
        }
        //end test
        /*$orders = Order::where("state",$state)->orderBy('created_at', 'desc')->get();
        $tempMonthYear =0;
        $tempDay = 0;
        $ships=Ship::all();

        //This temp export is added in order to loop through all the orders.
        $temp_order=new Order();
        $temp_order->created_at=Carbon::create(2018);
        $orders->push($temp_order);
        $size = count($orders);
        $has_id=0;*/
        $has_id = 0;
        $ships = Ship::where("type", "company")->get();
        $delivery_man = Ship::where("type", "person")->get();
        $districts = District::all();
        $stores = Store::all();
        $ship_id = $request->ship_id;
        $users = User::all();

        if ($request->exists("ship_id")) {
            return view('orders.orders_with_state', compact("months", "final2", "arr2", "final", "has_id", "ships", "items_count", "state", "ship_id", "users", "ships", "delivery_man", "districts", "stores"))->withErrors(["asdasd" => "عفوا لقد تم تجاوز الحد المسمح للاوردرات"]);
        }
        
        
        else if(sizeof($dates)==0){
            return view('orders.index', compact("months" ,"final2", "arr2", "final", "has_id", "ships", "items_count", "delivery_man", "users", "districts", "stores"))->withErrors(["asdasd" => "عفوا لم تم يتم تسجيل اي اوردر حتي الان"]);
     
        }

        return view('orders.orders_with_state', compact("months", "final2", "arr2", "final", "has_id", "ships", "items_count", "state", "users", "ships", "delivery_man", "districts", "stores"));
    }
    public function Search(Request $request)
    {
        $date = false;
        if ($request->type == "policy_id") {
            $order = Order::where("policy_id", $request->id)->first();
            if ($order != null) {
                $date = $order->getDate();

                return $date;
            }
        } else if ($request->type == "order_id") {
            $order = Order::find($request->id);
            if ($order != null) {
                $date = $order->getDate();
                return $date;
            }
        }

        return json_encode($date);
    }

    public function ApiSearch(Request $request)
    {

        try {
            if ($request->type == "policy_id") {

                $orders = Order::where("policy_id", $request->policy_id)->get();
            } else if ($request->type == "order_id") {
                $orders = Order::where("id", $request->order_id)->get();
            } else if ($request->type == "customer_phone") {
                $phone = Phone::where("phone", $request->customer_phone)->first();
                if ($phone != null) {
                    $orders = Order::where("customer_id", $phone->customer_id)->get();
                } else {
                    return json_encode(["data" => ["orders" => []],"code"=>200]);
                }
            }

            foreach ($orders as $order) {
                $ship_districts_ids = ShipDistrict::where("district_id", $order->district_id)->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id", "!=", $order->ship_id)->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order->district_id)->first()->cost;
                }

                $order->shippers = $ship;
                if ($order->ship_id != null && ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $order->district_id)->first() != null) {
                    $temp = Ship::find($order->ship_id);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order->district_id)->first()->cost;
                    if ($temp != null) {
                        $order->shippers->prepend($temp);
                    }
                }


                $order->ship = Ship::find($order->ship_id);

                $order->customer = Customer::find($order["customer_id"]);
                $order->phones = Phone::where("customer_id", $order["customer_id"])->pluck("phone");
            }


            return json_encode(["data" => ["orders" => $orders], "code" => 200, "count" => sizeof($orders)], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }
    }
    public function edit_order(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            $items = $order->items;
            foreach ($items as $item) {
                $quantity = DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->first()->quantity;
                DB::table("items")->where("name_id", $item->name_id)->where("size", $item->size)->update(["quantity" => $item->quantity + $quantity]);
            }
            Order_item::where("order_id", $id)->delete();
            $users = User::all()->pluck("id");


            $order->total_price_before_discount = $request->total_price_after_discount + $request->discount;
            $order->discount = $request->discount;
            $order->no_of_items = sizeof($request->items_id);
            if ($request->exists("details")) {
                $order->details = $request->details;
            }
            $order->receiving_date = Carbon::parse($request->receiving_date)->toDateString();
            $order->ordering_date = Carbon::now();
            
            $customer = null;
            if ($request->customer_id == 0) {
                $customer = new Customer();
              
            } else {
                $customer = Customer::find($request->customer_id);
            }
                $customer->name = $request->name;
                $customer->governorate = $request->governorate;

                $customer->customer_platform = $request->customer_platform;
                $customer->customer_link = $request->customer_link;
                $customer->type = "عادي";

                $customer->save();
               /* $phone_array = explode("-", $request->phone);


             
                foreach ($phone_array as $phone) {
                    $p = new Phone();
                    $p->phone = $phone;
                    $customer->phones()->save($p);
                }

                //  foreach ($request->address as $addres){
                $a = new Adress();
                $a->address = $request->address;
                $customer->addresses()->save($a);
                */

            $order->customer_id = $customer->id;
            if ($request->delivery_cost != 0) {
                $order->delivery = $request->delivery_cost;
            } else {
                $order->delivery = 0;
            }
            // $order->ship_id=DB::table("ships")->first()->id;

            if (Adress::where("customer_id", $customer->id)->where("address", $request->address)->first() == null) {
                $a = new Adress();
                $a->address = $request->address;
                $customer->addresses()->save($a);
            }
            if (Phone::where("customer_id", $customer->id)->where("phone", $request->phone)->first() == null) {
                $p = new Phone();
                $p->phone = $request->phone;
                $customer->phones()->save($p);
            }
            $order->receiving_address = $request->address;
            $order->user_id = Auth::user()->id;


            $order->completed = 1;
            $order->type = "جديد";
            $order->state = "انتظار";

            $order->save();
            $order=Order::find($order->id);
            $array_size = sizeof($request->items_id);
            $ids_array = $request->items_id;
            $quantity_array = $request->quantity;


            for ($i = 0; $i < $array_size; $i++) {
                $item = Item::find($ids_array[$i]);
                if ($item->quantity == 0) {
                    $unavaialble_alert = new Unavailable_alert();
                    $unavaialble_alert->order_id = $order->id;
                    $unavaialble_alert->name_id = $item->name_id;
                    $unavaialble_alert->size = $item->size;

                    $unavaialble_alert->state = "not_seen";
                    $unavaialble_alert->user_id = Auth::user()->id;
                    $unavaialble_alert->save();
                    $order->completed = 0;
                    $order->save();
                } else {
                    $quantity = $quantity_array[$i];
                    $order_item = new Order_item();
                    $order_item->name_id = $item->name_id;
                    $order_item->selling_price = $item->selling_price;
                    $order_item->buying_price = $item->buying_price;
                    $order_item->discount = $item->discount;
                    $order_item->size = $item->size;
                    $order_item->quantity = $quantity;
                    $order->items()->save($order_item);
                    if ($item->quantity > $quantity) {
                        $item->quantity = $item->quantity - $quantity;

                        if ($item->quantity <= 5 && Alert::where("item_id", $item->id)->first() == null) {
                            foreach ($users as $user_id) {
                                $alert = new Alert();
                                $alert->item_id = $item->id;
                                $alert->state = "not_seen";
                                $alert->user_id = $user_id;
                                $alert->save();
                            }
                        }
                    } else {
                        $item->quantity = 0;
                    }
                    $item->save();
                }
            }

            if (str_contains(url()->current(), 'api')) {
                $returned_obj = [];
                $returned_obj["order"] = $order;
                $returned_obj["order_items"] = $order->items;
                return json_encode(["data" => $returned_obj, "code" => 200], JSON_UNESCAPED_UNICODE);
            }
            if (ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $request->district_id)->first() != null) {
                
                    $ship_district = ShipDistrict::where("ship_id", $order->ship_id)->where("district_id", $request->district_id)->first();
                    $order->total_price_after_discount= $order->total_price() + $ship_district->cost - $order->discount;
                    $order->delivery=$ship_district->cost;
                    
            }
            else{
                    $order->ship_id=null;
                    $order->total_price_after_discount= $order->total_price()  - $order->discount;
                    $order->delivery=0;
                    
            }
            $order->save();


            echo "<script>window.close();</script>";
        } catch (\Throwable $th) {
            dd($th->getMessage());
            if (str_contains(url()->current(), 'api')) {
                return json_encode(["error"=>$th->getMessage(),"code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back();
        }
    }
    public function order_edit_create($id)
    {
                $stores = Store::all();
        $all_items = [];

        foreach ($stores as $store) {
            $items = Item::where("store_id", $store->id)->get();
            foreach ($items as $item) {
                $item->group = $item->name->name;
                $item->color = $item->name->color;
            }
            $items = $items->groupBy("group");
            foreach ($items as $key => $value) {
                $items[$key] = $value->groupBy("color");
            }
            $all_items[$store->id] = $items;
        }
        //dd($all_items);


        $customers = Customer::all();
        $names_id = Item::all()->pluck("name_id")->unique();
        $names = [];
        
        $names = Name::all()->pluck("name")->unique();
        $districts = District::all();

        $order = Order::find($id);
        $order_items = $order->items;
        foreach ($order_items as $i) {
            $i->main_item_id = Item::where("size", $i->size)->where("name_id", $i->name_id)->first()->id;
        }
        $customer = Customer::find($order->customer_id);


        return view("orders.order_edit", compact("order_items", "order", "customer", "all_items", "names", "districts"));
    }


    public function order_details($id)
    {
        $order = Order::find($id);
        $order->items = $order->items;
        foreach ($order->items as $item) {

            $item->name = $item->name->name;
        }
        $order->customer = $order->customer;
        $order->user = $order->user;

        $order->ship = $order->ship;
        $order->customer->phones = $order->customer->phones;
        $order->customer->addresses = $order->customer->addresses;


        return $order;
    }

    public function order_to_pdf($id)
    {

        $order = Order::find($id);
        //   return view("new_receipt",compact("order"));

        $pdf = \PDF::loadView('new_receipt', ["order" => $order]);
        //  return $pdf->stream();
        // $pdf->allow_charset_conversion=true;  // Set by default to TRUE
        //   $file = public_path("reciept_99.pdf");
        //   return response()->download($file);


        return Response::download($pdf->download("order-" . $order->id . ".pdf"));
    }

    public function online_order_store(Request $request)
    {
        $user = Auth::user();
        $order = new OnlineOrder();
        $order->customer_name = $request->customer_name;
        $order->customer_phone = $request->customer_phone;
        $order->customer_address = $request->customer_address;

        $total_price_before_discount = 0;
        $discount = $request->discount;
        $requestData = $request->all();
        $colors = $request->colors;
        $names = $request->names;
        $sizes = $request->sizes;
        $quantity_array = $request->quantity;




        for ($i = 0; $i < sizeof($colors); $i++) {
            $name = Name::where("color", $colors[$i])->where("name", $names[$i])->first();
            $item = Item::where("name_id", $name->id)->where("size", $sizes[$i])->first();
            $quantity = $quantity_array[$i];
            $order_item = new OnlineItem();
            $order_item->name_id = $item->name_id;
            $order_item->selling_price = $item->selling_price;
            if ($item->quantity == 0) {
                $order_item->selling_price = 0;
                $order->state = "غير متوفر";

                $order->save();
            }
            $order_item->buying_price = $item->buying_price;
            $order_item->discount = $item->discount;
            $order_item->size = $item->size;
            $order_item->quantity = $quantity;
            $total_price_before_discount += ($quantity * $item->selling_price);
            $order->save();


            $order->items()->save($order_item);
            if ($item->quantity > $quantity) {
                $item->quantity = $item->quantity - $quantity;

                if ($item->quantity <= 5 && Alert::where("item_id", $item->id)->first() == null) {
                    foreach ($users as $user_id) {
                        $alert = new Alert();
                        $alert->item_id = $item->id;
                        $alert->state = "not_seen";
                        $alert->user_id = $user_id;
                        $alert->save();
                    }
                }
            } else {
                $item->quantity = 0;
            }
            $item->save();
        }

        $order->type = "جديد";
        $order->state = "انتظار";
        $order->total_price_before_discount = $total_price_before_discount;
        $order->total_price_after_discount = $total_price_before_discount - $discount;
        $order->discount = $request->discount;
        $order->no_of_items = sizeof($names);
        if ($request->filled("details")) {
            $order->details = $request->details;
        }
        $order->receiving_date = $request->receiving_date;
        $order->ordering_date = Carbon::now();
        $order->save();

        dd($order->items);

        if ($user) {
        }



        dd($order);
    }


    public function online_orders_index()
    {

        $orders = OnlineOrder::all();

        return view("orders.online_orders", compact("orders"));
    }
    public function accept_online_order($id)
    {

        $online_order = OnlineOrder::find($id);
        $new_order = new Order();
        if (Order::max("policy_id") == null) {
            $new_order->policy_id = 400350;
        } else {
            $new_order->policy_id = Order::max("policy_id") + 1;
        }
        $new_order->total_price_before_discount = $online_order->total_price_after_discount;
        $new_order->total_price_after_discount = $online_order->total_price_after_discount;
        $new_order->discount = $online_order->discount;
        $new_order->no_of_items = sizeof($online_order->items);
        /* if($request->exists("details")) {
            $order->details = $request->details;
        }*/
        $new_order->receiving_date = $online_order->receiving_date;
        $new_order->receiving_address = $online_order->customer_address;

        $new_order->ordering_date = $online_order->ordering_date;
        $customer = new Customer();
        $exist_phone = Phone::where("phone", $online_order->phone)->first();
        if ($exist_phone == null) {
            $customer->name = $online_order->customer_name;
            // $customer->governorate=$online_order->governorate;

            $customer->type = "عادي";

            $customer->save();
            $phone_array = explode("-", $online_order->phone);



            foreach ($phone_array as $phone) {
                $p = new Phone();
                $p->phone = $phone;
                $customer->phones()->save($p);
            }

            //  foreach ($request->address as $addres){
            $a = new Adress();
            $a->address = $online_order->address;
            $customer->addresses()->save($a);

            //   }
        } else {
            $customer = Customer::find($exist_phone->customer_id);
        }
        $new_order->customer_id = $customer->id;


        if (Adress::where("customer_id", $customer->id)->where("address", $online_order->customer_address)->first() == null) {
            $a = new Adress();
            $a->address = $online_order->address;
            $customer->addresses()->save($a);
        }
        if (Phone::where("customer_id", $customer->id)->where("phone", $online_order->customer_phone)->first() == null) {
            $p = new Phone();
            $p->phone = $online_order->phone;
            $customer->phones()->save($p);
        }
        $online_order->receiving_address = $online_order->customer_address;
        $new_order->user_id = Auth::user()->id;


        $new_order->completed = 1;
        $new_order->type = "جديد";
        $new_order->state = "انتظار";

        $new_order->save();
        $array_size = sizeof($online_order->items);
        $ids_array = $online_order->items()->pluck("id");

        $online_order_items = OnlineItem::find($ids_array);
        foreach ($online_order_items as $item) {

            $order_item = $item;
            $order_item->order_id = $new_order->id;

            $store_item = Item::where("name_id", $item->name_id)->where("size", $item->size)->first();
            if ($store_item->quantity > $order_item->quantity) {
                $store_item->quantity = $store_item->quantity - $order_item->quantity;

                if ($store_item->quantity <= 5 && Alert::where("item_id", $item->id)->first() == null) {
                    foreach ($users as $user_id) {
                        $alert = new Alert();
                        $alert->item_id = $item->id;
                        $alert->state = "not_seen";
                        $alert->user_id = $user_id;
                        $alert->save();
                    }
                }
            } else {
                if ($store_item->quantity < $order_item->quantity) {
                    $order_item->selling_price = 0;
                    $new_order->state = "غير متوفر";
                    $new_order->save();
                } else {
                    $store_item->quantity = 0;
                }
            }
            Order_Item::create($order_item->toArray());
            //  $new_order->items()->save($order_item);

            $store_item->save();
        }




        return $new_order;
    }



    public function orders_table(Request $request)
    {
        $orders = null;
        if (Auth::user()->ship_id != null) {
            $orders = Order::where("ship_id", Auth::user()->ship_id)->get();
        } else {
            $orders = Order::all();
        }
        $items = null;
        $flag_that_all_items_are_passed = "true";

        if ($request->has("store_id")) {
            $items = Item::where("store_id", $request->store_id)->get();
            $flag_that_all_items_are_passed = $request->store_id;
        } else {
            $items = Item::all();
        }
        $items_count = $items->count();
        $items_sum = $items->sum("quantity");
        // $items_price=$items->sum("total_price_after_discount");
        $names = Name::all();
        $items_overall_quantity = $items->sum("quantity");

        $items_overall_price = 0;
        foreach ($items as $item) {

            $items_overall_price += ($item->buying_price * $item->quantity);
        }
        $stores = Store::all();
        //  dd($flag_that_all_items_are_passed===1);
        //dd(\gettype($stores->first()->id));
        return view('orders.orders_table', compact("orders", 'items', "names", "items_overall_price", "items_overall_quantity", "items_count", 'items_sum', 'stores', 'flag_that_all_items_are_passed'));
    }



    public function GetItemsForOrderApi(Request $request, $id)
    {
        $show = $request->show;
        try {
            $order_items = Order_item::where("order_id", $id)->get();
            if ($show == 1) {
                $temp_items = [];
                foreach ($order_items as $item) {
                    $item->name = Name::find($item->name_id);
                    $temp_items[] = $item;
                }
                return json_encode(["data" => $temp_items, "code" => 200], JSON_UNESCAPED_UNICODE);
            }
            $items_ids = [];
            foreach ($order_items as $order_item) {
                $items_ids[] = Item::where("name_id", $order_item->name_id)->where("size", $order_item->size)->first()->id;
            }

            $selected_store_items = Item::whereIn("id", $items_ids)->get();


            $selected_store_items->map(function ($selected_store_item) {
                $selected_store_item["selected"] = 1;
                return $selected_store_item;
            });


            $store_items = Item::whereNotIn("id", $items_ids)->get();

            $store_items->map(function ($store_item) {
                $store_item["selected"] = 0;
                return $store_item;
            });


            $merged = $selected_store_items->merge($store_items); // Contains foo and bar.





            if (str_contains(url()->current(), 'api')) {
                $returned_obj = [];
                foreach ($merged as $item) {
                    $item->name = Name::find($item->name_id);
                }
                $returned_obj["store_items"] = $merged;
                return json_encode(["data" => $returned_obj, "code" => 200], JSON_UNESCAPED_UNICODE);
            }
        } catch (\Throwable $th) {

            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني", "error" => $th->getMessage()], JSON_UNESCAPED_UNICODE);
        }
    }
    
    
    public function track_phone_orders($phone){
        
        $phone=Phone::where("phone",$phone)->first();
        if($phone!=null){
            $orders=Order::where("customer_id",$phone->customer_id)->get();
            foreach($orders as $order){
                $order->items=Order_item::where("order_id",$order->id)->get();
            }
         return json_encode(["data" => $orders, "code" => 200], JSON_UNESCAPED_UNICODE);

        }
        
         return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);

        
        
    }
    
    
}
