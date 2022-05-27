<?php

namespace App\Http\Controllers\Report;

use App\Customer;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Item;
use App\Order;
use App\Order_item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function most_paying_customers()
    {
        $customers=Customer::all();
        $static_array=[];
        foreach ($customers as $customer){
            $static_array[$customer->id]=$customer->orders()->count();


        }
        arsort($static_array);


        return view('most_paying_customers', compact('static_array'));
    }
    public function less_paying_customers()
    {
        $customers=Customer::all();
        $static_array=[];
        foreach ($customers as $customer){
            $static_array[$customer->id]=$customer->orders()->count();


        }
        asort($static_array);


        return view('less_paying_customers', compact('static_array'));
    }
    public function escaped_customers()
    {
        $customers=Customer::where("type","متهرب")->get();
        $static_array=[];
        foreach ($customers as $customer){
            $static_array[$customer->id]=$customer->orders()->count();


        }



        return view('most_paying_customers', compact('static_array'));
    }
    public function waiting_customers()
    {
        $orders=Order::where("state","انتظار")->orderBy("created_at","dsc")->get();
        $customers=Customer::all();

        $static_array=[];
        foreach ($customers as $customer){


            $to =  Carbon::now();
            if($customer->orders()->where("state","انتظار")->orderBy("created_at","Asc")->first()!=null){
                $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$customer->orders()->where("state","انتظار")->orderBy("created_at","Asc")->first()->created_at );

            }
            else{
                $from=$to;
            }

            $diff_in_days = $to->diffInDays($from);
            $static_array[$customer->name]=$diff_in_days;


        }
        
        arsort($static_array);
        return view('most_waiting_customers', compact('static_array'));




        //  return view('restoreds.index', compact('restoreds'));
    }
    public function most_profit_items(){
        $items=Item::all();
        $static_array=[];


        foreach ($items as $item){
            $static_array[$item->name->name." ".$item->name->code." ".$item->size]=$item->selling_price-$item->buying_price;

        }
        arsort($static_array);
        return view("most_profit_items", compact('static_array'));




    }
    public function less_profit_items(){
        $items=Item::all();
        $static_array=[];


        foreach ($items as $item){
            $static_array[$item->name->name." ".$item->name->code." ".$item->size]=$item->selling_price-$item->buying_price;

        }
        asort($static_array);
        return view("less_profit_items", compact('static_array'));




    }
    public function most_sell_items(){
        $items=Item::all();
        $static_array=[];


        foreach ($items as $item){
            $static_array[$item->name->name." ".$item->name->code." ".$item->size]=Order_item::where("name_id",$item->name_id)->where("size",$item->size)->count();

        }
        arsort($static_array);
        return view("most_sell_items", compact('static_array'));


    }
    public function less_sell_items(){
        $items=Item::all();
        $static_array=[];


        foreach ($items as $item){
            $static_array[$item->name->name." ".$item->name->code." ".$item->size]=Order_item::where("name_id",$item->name_id)->where("size",$item->size)->count();

        }
        asort($static_array);
        return view("less_sell_items", compact('static_array'));




    }
    public function most_available_items(){
        $items=Item::all();
        $static_array=[];


        foreach ($items as $item){
            $static_array[$item->name->name." ".$item->name->code." ".$item->size]=$item->quantity;

        }
        arsort($static_array);
        return view("most_available_items", compact('static_array'));



    }
    public function less_available_items(){
        $items=Item::all();
        $static_array=[];


        foreach ($items as $item){
            $static_array[$item->name->name." ".$item->name->code." ".$item->size]=$item->quantity;

        }
        asort($static_array);
        return view("less_available_items", compact('static_array'));




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
        $restored=Restored::find($id);
        $item=Item::where("name_id",$restored->name_id)->where("size",$restored->size)->first();
        $item->quantity=$item->quantity+$restored->quantity;
        $item->save();
        Restored::destroy($id);
        return redirect()->back();



    }
}
