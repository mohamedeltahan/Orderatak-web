<?php

namespace App\Http\Controllers\Ship;

use App\Customer;
use App\District;
use App\Export;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Order_item;
use App\Ship;
use App\ShipPayment;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ShipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        try {
            
            $ships=Ship::where("type","company")->get();
            foreach($ships as $ship){
                $ship->total_payments=$ship->payments->sum();
                $ship->orders_count=$ship->orders->count();
                $ship->deserved_amount=$ship->GetDeservedAmount();
                unset($ship->payments);
                unset($ship->orders);

            }

            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["ships"]=$ships;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/shipping_companies.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
            
            return view('ships.index', compact('ships'));
        } catch (\Throwable $th) {
            
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back(); 
        }
    }

    public function deliveryman_index(Request $request)
    {
        try {
            
            $delivery=Ship::where("type","person")->get();
            foreach($delivery as $ship){
                $ship->total_payments=$ship->payments->sum();
                $ship->orders_count=$ship->orders->count();
                $ship->deserved_amount=$ship->GetDeservedAmount();
                unset($ship->payments);
                unset($ship->orders);

            }

            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["delivery_men"]=$delivery;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/delivery_men.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }

            return view('deliveryman.index', compact('delivery'));

        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back(); 
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('ships.create');
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

        try {
            $requestData = $request->all();

            $ship=Ship::create($requestData);

            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                if($request->type=="person"){
                    $returned_obj["delivery_men"]=$ship;

                }
                else{
                    $returned_obj["ship"]=$ship;

                }
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
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
            $ship = Ship::find($id);
            $ship->total_payments=$ship->payments->sum();
            $ship->orders=$ship->orders;
            $ship->orders_count=$ship->orders->count();
            $ship->deserved_amount=$ship->GetDeservedAmount();
            unset($ship->payments);
            unset($ship->orders);


            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["ship"]=$ship;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/shipping_companies.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }

            return view('ships.show', compact('ship'));
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back();   
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
        $ship = Ship::findOrFail($id);

        return view('ships.edit', compact('ship'));
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
            
        $ship=Ship::find($id);
        /*
                if($request->has("phone")){
                    $phones=$ship->get_phones();
                    //$phones[$request->index]=$request->value;
                    $ship->phone=($request->phone);
                    $ship->save();
                    return "1";
        
                }
        
                else{
                    $ship->update($request->all());
        
                }
        */  
         $ship->update($request->all());
         if(str_contains(url()->current(), 'api')){
            $returned_obj=[];
            $returned_obj["ship"]=$ship;
            return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
        }            
        
        return redirect()->back();
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back(); 
        
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
         Ship::destroy($id);
         if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["state"]=1;
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
         }

         return redirect()->back();
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back(); 
        }
    }

    public function orders(Request $request,$id){
        $arr=[];
        $dates=Order::where("ship_id",$id)->orderBy('created_at', 'DESC')->pluck("created_at");
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

        foreach ($arr2 as $month){
            $final2=[];
            foreach ($arr as $day){
                $temp_count=0;
                if(substr($day,0,7)==$month){
                    $final2[$day]=Order::where("ship_id",$id)->whereDate('created_at',"=", $day)->get(["total_price_after_discount","id"]);
                    foreach ($final2[$day] as $order){

                        $temp_count+=$order->items()->sum("quantity");
                    }
                    $items_count[$day]=$temp_count;

                }
            }
            $months[$month]=$final2;




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

        $has_id=0;
        $ships=Ship::all();
        $ship_id=$id;
        $users=User::all();
        $ship=Ship::find($id);
        $orders=Order::where("ship_id",$id)->orderBy('created_at', 'DESC')->get();
        $districts=District::all();
        $orders_with_the_ship=Order::where("ship_id",$ship_id)->where("state","تم التسليم لشركة الشحن")->orWhere("state","تم الشحن")->orWhere("state","مرتجع")->orWhere("state","مرتجع جزئي")->get();
        $number_of_items_with_the_ship=Order_item::whereIn("order_id",$orders_with_the_ship->pluck("id")->toArray())->count();
        $orders_restoreds_with_the_ship=Order::where("ship_id",$ship_id)->where("state","مرتجع")->count();
        $orders_delivered_with_the_ship=Order::where("ship_id",$ship_id)->where("state","تم الشحن")->get();
        $money_with_the_ship=$orders_delivered_with_the_ship->sum("total_price_after_discount")-$orders_delivered_with_the_ship->sum("delivery");
        $money_paid_with_the_ship=Ship::find($id)->payments()->sum("amount");

        $orders_with_the_ship=$orders_with_the_ship->count();
        $orders_delivered_with_the_ship=$orders_delivered_with_the_ship->count();

        $delivery_man=Ship::where("type","person")->get();
        $tag=$request->tag;

        return view('orders.ship_orders',compact("months","districts","final2","arr2","final","has_id","ships","items_count","ship_id","users","delivery_man","orders","orders_with_the_ship","number_of_items_with_the_ship","orders_restoreds_with_the_ship","orders_delivered_with_the_ship","money_with_the_ship","money_paid_with_the_ship","ship","tag"));



    }


    public function GetShipPayments($id)
    {
        try {
            $orders_with_the_ship=Order::where("ship_id",$id)->where("state","تم التسليم لشركة الشحن")->orWhere("state","تم الشحن")->orWhere("state","مرتجع")->orWhere("state","مرتجع جزئي")->get();
            $number_of_items_with_the_ship=Order_item::whereIn("order_id",$orders_with_the_ship->pluck("id")->toArray())->count();
            $orders_restoreds_with_the_ship=Order::where("ship_id",$id)->where("state","مرتجع")->count();
            $orders_delivered_with_the_ship=Order::where("ship_id",$id)->where("state","تم الشحن")->get();
            $money_with_the_ship=$orders_delivered_with_the_ship->sum("total_price_after_discount")-$orders_delivered_with_the_ship->sum("delivery");
            $money_paid_with_the_ship=Ship::find($id)->payments()->sum("amount");
            $payments=ShipPayment::where("ship_id",$id)->paginate();

            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["payments"]=$payments;
                $returned_obj["deserved_amount"]=Ship::find($id)->GetDeservedAmount();
                $returned_obj["money_with_the_ship"]=$money_with_the_ship;
                $returned_obj["money_paid_with_the_ship"]=$money_paid_with_the_ship;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/shipping_companies.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
            } catch (\Throwable $th) {
            
                if(str_contains(url()->current(), 'api')){
                    return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
                }
                return redirect()->back(); 
       
            }
        


    }

    public function Check_Ship_District(Request $request)
    {
        $ship=Ship::find($request->ship_id);
        return $ship->Check_District($request->district_id);   
        
    }

}
