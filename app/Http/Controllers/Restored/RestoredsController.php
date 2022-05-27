<?php

namespace App\Http\Controllers\Restored;

use App\Customer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\Name;
use App\Order;
use App\Restored;
use App\Store;
use Illuminate\Http\Request;

class RestoredsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $restoreds=null;
        $flag_that_all_items_are_passed="true";
        if($request->has("ship_id")){

            
        if($request->has("store_id")){
            $restoreds=Restored::where("store_id",$request->store_id)->where("ship_id",$request->ship_id)->get();
            $flag_that_all_items_are_passed=$request->store_id;
 
        }
        else{
            $restoreds=Restored::where("ship_id",$request->ship_id)->get();
        }
        
        
        $stores=Store::all();

        $restored_quantity=$restoreds->sum("quantity");
        //$restored_order_count=sizeof(Restored::all()->pluck("order_id")->unique());
        $confirmed_restored=$restoreds->where("confirmed",1)->count();
        $unconfirmed_restored=$restoreds->where("confirmed",0)->count();



        return view('restoreds.index', compact('restoreds','restored_quantity','unconfirmed_restored','confirmed_restored','flag_that_all_items_are_passed','restoreds','stores'));


        }

        if($request->has("store_id")){
            $restoreds=Restored::where("store_id",$request->store_id)->get();
            $flag_that_all_items_are_passed=$request->store_id;
 
        }
        else{
            $restoreds=Restored::all();
 
        }
        $stores=Store::all();

        $restored_quantity=Restored::all()->sum("quantity");
        //$restored_order_count=sizeof(Restored::all()->pluck("order_id")->unique());
        $confirmed_restored=Restored::where("confirmed",1)->count();
        $unconfirmed_restored=Restored::where("confirmed",0)->count();



        return view('restoreds.index', compact('restoreds','restored_quantity','unconfirmed_restored','confirmed_restored','flag_that_all_items_are_passed','restoreds','stores'));
    }

    public function ApiRestoreds(Request $request)
    {

        try {
            $restoreds=Restored::where("ship_id",$request->ship_id);
            $returned_obj=[];
            $restoreds=json_decode($restoreds->paginate()->toJson(),true);
            $temp=[];
            foreach($restoreds["data"] as $data){
               $data["customer"]=Customer::find(Order::find($data["order_id"])->customer_id);
               $data["name"]=Name::find($data["name_id"]);
               $temp[]=$data;
            }
            $restoreds["data"]=$temp;
            $returned_obj["restoreds"]=$restoreds;
            $returned_obj["unconfirmed_restored"]=Restored::where("ship_id",$request->ship_id)->where("confirmed",0)->count();
            $returned_obj["confirmed_restoreds"]=Restored::where("ship_id",$request->ship_id)->where("confirmed",1)->count();
    
            return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://www.productplan.com/uploads/product-spec-template.png","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
    
        } catch (\Throwable $th) {
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('restoreds.create');
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

        $requestData = $request->all();

        Restored::create($requestData);

        return redirect('restoreds')->with('flash_message', 'Restored added!');
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
        $restored = Restored::findOrFail($id);

        return view('restoreds.show', compact('restored'));
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
        $restored = Restored::findOrFail($id);

        return view('restoreds.edit', compact('restored'));
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

        $restored = Restored::findOrFail($id);
        $restored->update($requestData);

        return redirect('restoreds')->with('flash_message', 'Restored updated!');
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
        Restored::destroy($id);

        return redirect('restoreds')->with('flash_message', 'Restored deleted!');
    }
    public function confirm($id){
        try {
            
            $restored=Restored::find($id);
            $item=Item::where("name_id",$restored->name_id)->where("size",$restored->size)->where("store_id",$restored->store_id)->first();
        
            if($item==null){
            $item=Item::where("name_id",$restored->name_id)->where("size",$restored->size)->first();
            }
        
            $item->quantity=$item->quantity+$restored->quantity;
            $restored->confirmed=1;
            $restored->save();

            $item->save();
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["restored"]=$restored;
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
            }
            return $restored->id;
        } catch (\Throwable $th) {
            
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);

        }



    }
}
