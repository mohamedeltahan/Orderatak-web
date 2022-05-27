<?php

namespace App\Http\Controllers\Customer;

use App\Adress;
use App\Export;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;
use App\Order;
use App\Phone;
use App\Store;

use App\Ship;
use App\ShipDistrict;
use App\User;
use Carbon\Carbon;
use Faker\Provider\zh_TW\Address;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\New_;
use Psy\Util\Json;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {


           
        if(str_contains(url()->current(), 'api')){
            try {
                $governorate=$request->governorate;
                $customer_platform=$request->customer_platform;
                $type=$request->type;
                $customers=null;
                
                if($governorate!=null){
                    $customers=Customer::where("govenorate",$governorate)->paginate();
                }
    
                else if($customer_platform!=null){
                    $customers=Customer::where("customer_platform",$customer_platform)->paginate();
                }
                else if($type!=null){
                    $customers=Customer::where("type",$type)->paginate();
                }
                else{
                    $customers=Customer::paginate();
                }
                $customers=json_decode($customers->toJson(),true);
                $arr=[];
                foreach($customers["data"] as $customer){
                    $customer["phones"]= Customer::find($customer["id"])->phones()->pluck("phone");
                    $customer["addresses"]= Customer::find($customer["id"])->addresses()->pluck("address");
                    $arr[]=$customer;
                }
                $customers["data"]=$arr;
                
                $returned_obj=[];
                $returned_obj["customers"]=$customers;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/customers.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
        
            } catch (\Throwable $th) {
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
      }
        
        $customers = Customer::limit(15)->get();
        $escaped_customers=Customer::where("type","متهرب")->count();
        $normal_customers=Customer::where("type","عادي")->count();
        $now = Carbon::now();
        if(Order::whereYear('created_at', '=', $now->year)->whereMonth('created_at', '=', $now->month)->count()>=Auth::user()->no_of_customers){
            return view('customers.index', compact('customers','escaped_customers','normal_customers'))->withErrors(["error"=>"لقد تم تجاوز الحد المسموح من العملاء"]);

        }
        return view('customers.index', compact('customers','escaped_customers','normal_customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
      //  return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function arraytostr($arr){
        $str="";
        foreach ($arr as $ar){
            $str.=$ar."-";
        }
        return $str;

    }
    public function store(Request $request)
    {
        $now=Carbon::now();
        if(Order::whereYear('created_at', '=', $now->year)->whereMonth('created_at', '=', $now->month)->count()>=Auth::user()->no_of_customers){
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"لقد تم تجاوز عدد العملاء المسموح"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back();
        }
       /* if(Customer::all()->count()>=Auth::user()->no_of_customers){
            return redirect()->route("customers.index");
        }*/
        try {
            $customer=new Customer();
            $phones_arr=[];
            foreach ($request->phone as $p) {
                $phones_arr[]=$p;
            }
            if(Phone::whereIn("phone",$phones_arr)->first()){
              $customer=Customer::find(Phone::whereIn("phone",$phones_arr)->first()->customer_id);
            }
            $customer->name=$request->name;
            $customer->customer_platform=$request->customer_platform;
            $customer->customer_link=$request->customer_link;
            $customer->governorate=$request->governorate;
            $customer->type="عادي";
            $customer->save();
            foreach ($request->phone as $p) {
                if(Phone::where("phone",$p)->first()==null){
                    $phone=new Phone();
                    $phone->phone=$p;
                    $customer->phones()->save($phone);
                }
            }
            foreach ($request->address as $a) {
                if(Adress::where("address",$a)->where("customer_id",$customer->id)->first()==null){
                    $address=new Adress();
                    $address->address=$a;
                    $customer->addresses()->save($address);
                }
            }      
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $customer->phones= $customer->phones()->pluck("phone");
                $customer->addresses= $customer->addresses()->pluck("address");
                $returned_obj["customer"]=$customer;
                
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/customers.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE); 
            }
            return redirect()->back();

       } catch (\Throwable $th) {
                      
            if(str_contains(url()->current(), 'api')){
                        return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            else{
                
            return redirect()->back()->withErrors(["حدثت مشكلة يرجي مراجعة الدعم الفني"]);
            }
     
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

        if(str_contains(url()->current(), 'api')){
            try {
                
            $customer=Customer::find($id);
            $customer->phones= $customer->phones()->pluck("phone");
            $customer->addresses= $customer->addresses()->pluck("address");
            $returned_obj=[];
            $returned_obj["customer"]=$customer;
            return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/customers.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE); 
            } catch (\Throwable $th) {
                
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);

            }
        }

        try {
            $dates=Order::where("customer_id",$id)->pluck("created_at");
            $arr=[];
            foreach ($dates as $date){
                $arr[]=explode(" ",$date)[0];
    
            }
            $arr=array_unique($arr);
    
    
            $arr2=[];
            foreach ($arr as $ar){
    
                $arr2[]=substr($ar,0,7);
    
            }
            $arr2=array_unique($arr2);
    
            $final=new Collection([]);
    
            $final2=[];
            $months=[];
            $items_count=[];
    
            foreach ($arr2 as $month) {
                $final2 = [];
                foreach ($arr as $day) {
                    $temp_count = 0;
                    if (substr($day, 0, 7) == $month) {
                        $final2[$day] = Order::where("customer_id",$id)->whereDate('created_at', "=", $day)->get(["total_price_after_discount", "id"]);
                        foreach ($final2[$day] as $order) {
    
                            $temp_count += $order->items()->sum("quantity");
                        }
                        $items_count[$day] = $temp_count;
    
                    }
                }
                $months[$month] = $final2;
            }
    
    
            $has_id=1;
            $ships=Ship::where("type","company")->get();
            $delivery_man=Ship::where("type","person")->get();
            $customer_id=$id;
            $customer=Customer::find($customer_id);
            $users=User::all();
            $stores=Store::all();
            return view('orders.orders_for_customer',compact("months","final2","arr2","final","has_id","ships","items_count","customer_id","customer","users","delivery_man","stores"));
      
        } catch (\Throwable $th) {
                 
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
        }

    }
    public function get_order_for_customer(Request $request,$id){

        $orders=Order::where("customer_id",$id)->whereDate("created_at","=",$request->date)->get();
        foreach ($orders as $order){

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
        return $orders ;
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
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
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


        try {
            $customer = Customer::findOrFail($id);
            if($request->has("phone" )){

                Phone::where("customer_id",$id)->delete();

                foreach ($request->phone as $phone){
                    if($phone==null || Phone::where("phone",$phone)->where("customer_id",$id)->first()!=null){continue;}
                    $new_phone=new Phone();
                    $new_phone->phone=$phone;
                    $customer->phones()->save($new_phone);
                }



            }
            if($request->has("address")){
                Adress::where("customer_id",$id)->delete();
                foreach ($request->address as $address){
                    if($address==null || Adress::where("address",$address)->where("customer_id",$id)->first()!=null){continue;}

                    $new_address=new Adress();
                    $new_address->address=$address;
                    $customer->addresses()->save($new_address);
                }

            }

            $customer->update($request->except(["phone","address"]));


            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["customer"]=$customer;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/customers.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE); 
            }
            return redirect('customers')->with('flash_message', 'Customer updated!');



        } catch (\Throwable $th) {
                
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);

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
            
            Customer::destroy($id);
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["state"]=1;
                return json_encode(["data"=>$returned_obj,"code"=>200]);
            }
            

            return redirect()->back();
        } catch (\Throwable $th) {
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);

        }
    }
    public function load_more($index){


         $customers=Customer::where("id",">",$index)->limit(15)->get();
         foreach ($customers as $customer){
             $customer->phones= $customer->phones()->pluck("phone");
             $customer->addresses= $customer->addresses()->pluck("address");
         }
         return $customers;


    }
    public function search(Request $request){

        if($request->type=="phone"){
            
            $phones=Phone::where("phone",$request->value)->pluck("customer_id")->unique()->values();
            if(sizeof($phones)!=0){
                $customers=Customer::whereIn("id",$phones)->get();
                foreach ($customers as $customer){
                    $customer->phones= $customer->phones()->pluck("phone");
                    $customer->addresses= $customer->addresses()->pluck("address");
                }
                return $customers;
            }
        }
        if($request->type=="name"){
            $customers= Customer::where("name",$request->value)->get();

            foreach ($customers as $customer){
                $customer->phones= $customer->phones()->pluck("phone");
                $customer->addresses= $customer->addresses()->pluck("address");
            }
            return $customers;

        }


    }

    public function ApiGetCustomerOrders(Request $request,$id)
    {
        try {
            $customer=Customer::find($id);
            $orders=Order::where("customer_id",$id);
            $orders=json_decode($orders->paginate()->toJson(),true);
            $temp_arr=[];
            foreach($orders["data"] as $order){
                $ship_districts_ids = ShipDistrict::where("district_id", $order["district_id"])->pluck("ship_id")->toArray();
                $ship = Ship::whereIn("id", $ship_districts_ids)->where("id","!=",$order["ship_id"])->get();
                foreach ($ship as $man) {
                    $man->delivery_cost = ShipDistrict::where("ship_id", $man->id)->where("district_id", $order["district_id"])->first()->cost;
                }
                
                $order["shippers"] = $ship;
                if($order["ship_id"]!=null && ShipDistrict::where("ship_id", $order["ship_id"])->where("district_id", $order["district_id"])->first()!=null){
                    $temp=Ship::find($order["ship_id"]);
                    $temp->delivery_cost = ShipDistrict::where("ship_id", $temp->id)->where("district_id", $order["district_id"])->first()->cost;
                    if($temp!=null){
                         $order["shippers"]->prepend($temp);
                    }
                }


            $order["ship"]=Ship::find($order["ship_id"]);
            $temp_arr[]=$order;
            }
            $orders["data"]=$temp_arr;

            $returned_obj=[];
            $returned_obj["orders"]=$orders;
            $returned_obj["customer"]=$customer;
            $returned_obj["phones"]=Phone::where("customer_id",$order["customer_id"])->pluck("phone");

            return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/customers.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني","error"=>$th->getMessage()],JSON_UNESCAPED_UNICODE);
        }
    }

    public function ApiSearch(Request $request){

        try {
            $value=$request->value;
            $customers=DB::table("customers")
            ->join('phones', 'phones.customer_id', '=', 'customers.id')
            ->join("adresses","adresses.customer_id","customers.id");

            
            
            $customers=$customers->where("customers.name","like","%".$value."%")
                ->orWhere(function($query) use ($value){
                $query->orWhere("customers.customer_link","like","%".$value."%");
                $query->orWhere("phones.phone","like","%".$value."%");
                $query->orWhere("adresses.address","like","%".$value."%");
                });


                
            $ids=$customers->get()->pluck("customer_id")->unique();

            $customers=json_decode(Customer::whereIn("id",$ids)->paginate()->toJson(),true);
            $data2=[];
            foreach($customers["data"] as $customer){
                $customer["phone"]=Phone::where("customer_id",$customer["id"])->pluck("phone")->toArray();
                $customer["address"]=Adress::where("customer_id",$customer["id"])->pluck("address")->toArray();
                $data2[]=$customer;
            }
            $customers["data"]=$data2;
            
            return json_encode(["data"=>["customers"=>$customers],"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/customers.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);

            } catch (\Throwable $th) {
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
        



    }

    public function CheckIfCustomerExist($phone)
    {
        try {
            $phone=Phone::where("phone",$phone)->first();
            if($phone!=null){
                $customer=Customer::find($phone->customer_id);
                $addresses=Adress::where("customer_id",$customer->id)->pluck("address");
                return json_encode(["data"=>["customer"=>$customer,"addresses"=>$addresses]],JSON_UNESCAPED_UNICODE);

            }
            else{
                return json_encode(["data"=>["customer"=>null,"addresses"=>null],"code"=>200],JSON_UNESCAPED_UNICODE);

            }
         } catch (\Throwable $th) {
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);

        }
        
    }
}
