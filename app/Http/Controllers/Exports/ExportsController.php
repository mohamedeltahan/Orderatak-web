<?php

namespace App\Http\Controllers\Exports;

use App\Events\exports_added;
use App\Exporter_transaction;
use App\Exports\ExportsExport;
use App\Exports_item;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Export;
use App\exporter as AppExporter;
use App\Item;
use App\Name;
use App\Payment;
use App\Store;
use App\User;
use Carbon\Carbon;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\Exporter\Exporter;

class ExportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $exports = Export::orderBy('created_at', 'desc')->get();
            $tempMonthYear =0;
            $tempDay = 0;

            //This temp export is added in order to loop through all the orders.
            $temp_export=new Export();
            $temp_export->created_at=Carbon::create(2018);
            $exports->push($temp_export);
            $size = count($exports);
            $has_id=0;
            return view('exports.index', compact('exports',"size","tempDay","tempMonthYear","has_id"));
        } catch (\Throwable $th) {
            return redirect()->back();
        }

    }

    public function ApiIndex(Request $request)
    { 
        try {
            $from=$request->from;
            $to=$request->to;
            $exports = Export::where("created_at", ">=",$from)->where("created_at","<=",$to)->orderBy('created_at', 'desc')->get();
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["exports"]=$exports;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/exports.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
    
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
         $names=Name::all();
         $exporters=\App\exporter::all();
         return view('exports.create',compact("names","exporters"));
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

        try {
            
        // first store export
        $export=new Export();
        $export->total_price_after_discount=$request->total_price_after_discount;
        $export->discount=$request->discount;
        $export->no_of_items=sizeof($request->items_id);
        $export_date=Carbon::parse($request->receiving_dates)->toDateString();
       /* $export_date->hour=Carbon::now()->hour;
        $export_date->minute=Carbon::now()->minute;
        */
        $export->receiving_dates=$export_date;
        $export->receipt_id=$request->receipt_id;
        $export->exporter_id=$request->exporter_id;
        $export->user_id=Auth::user()->id;

        $export->save();
        $export=Export::find($export->id);
        //then store each item
        $ids_array=$request->items_id;
        $quantity_array=$request->items_quantity;
        $size_array=$request->items_size;
        $buying_price_array=$request->items_buying_price;
        $selling_price_array=$request->items_selling_price;
        $discount_array=$request->items_discount;
        $array_size=sizeof($ids_array);
        for($i=0;$i<$array_size;$i++){
            //find this name and check if item with this name added before
            $name=Name::find($ids_array[$i]);
            $item= new Item();
            $item->name_id=$ids_array[$i];
            $item->quantity=$quantity_array[$i];
            $item->size=$size_array[$i];
            $item->buying_price=$buying_price_array[$i];
            $item->selling_price=$selling_price_array[$i];
            $item->discount=$discount_array[$i];
            $item->store_id=DB::table("stores")->first()->id;


            //check if items not exist so add it

            if($item->the_same_item_exist()==null){
                $item->save();

            }
            else{
                $name->items()->where("size",$item->size)->update(["quantity"=>$item->quantity+$item->get_exist_quantity()]);

            }


            //add this item to export_items llfwateeer
            $item->export_id=$export->id;
            Exports_item::create($item->toArray());
            


        }

            $export_transaction=new Exporter_transaction();
            $export_transaction->paid=$request->paid;
            $export_transaction->paid_at=$request->receiving_dates;

            $export_transaction->user_id=Auth::user()->id;
            $export->exporter_transactions()->save($export_transaction);

            $payment=new Payment();
            $payment->method="تم تسديدها في الفاتورة";
            $payment->receipt_id=$request->receipt_id;
            $payment->paid_at=$request->receiving_dates;
            $payment->paid=$request->paid;

            $payment->details=$request->details;
            $payment->exporter_id=$request->exporter_id;
            $payment->save();
            event(new exports_added($export));

            $has_id=0;

            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["export"]=$export;
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
            }
    
            return redirect('exports');
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
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
        try {
            
            $export = Export::find($id);
            $export->paid=Exporter_transaction::where("export_id",$id)->first()->paid;
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];          
                $export->exporter=AppExporter::find($export->exporter_id);
                $returned_obj["export"]=$export;
                $returned_obj["export_items"]=Exports_item::where("export_id",$id)->get();
                foreach($returned_obj["export_items"] as $item){
                    $item->name=Name::find($item->name_id);
                }
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/exports.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
           }

           return view('exports.show', compact('export'));
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

        $export = Export::findOrFail($id);
        $export->update($requestData);

        return redirect('exports')->with('flash_message', 'Export updated!');
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
        $export=Export::find($id);
        foreach ($export->exports_items as $item){
            $export->delete_this_item($item);
        }
        Export::destroy($id);
        
        if(str_contains(url()->current(), 'api')){
            $returned_obj=[];
            $returned_obj["state"]=1;
            return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
        }

        return redirect('exports')->with('flash_message', 'Export deleted!');
    }
    public function delete_item(Request $request,$id){
        try {
            
            $export=Export::find($request->id);
            $item=Exports_item::find($id);
            $export->delete_this_item($item);
            return redirect()->back();
        } catch (\Throwable $th) {
            
        }


    }
    public function transactions($id){
        $export=Export::find($id);
        return view("exporter_transactions.index",compact($export));

    }
    public function export_to_excel(Request $request){
       try {
             $exportable=new ExportsExport($request->start,$request->end);
            
        } catch (\Throwable $th) {
            return redirect()->back();
            
        }




        return Excel::download($exportable, 'exports.xlsx');

    }
    public function exports_with_states(Request $request){
        dd($request);


        $exports=Export::where("state",$request->state)->get();
        $state=$request->state;
        return view("exports_with_states",compact("exports","state"));





    }

    public function EditExportApi(Request $request ,$id)
    {

        
        $requestData = $request->all();
        // first update export
        $export=Export::find($id);
        $export->total_price_after_discount=$request->total_price_after_discount;
        $export->discount=$request->discount;
        $export->no_of_items=sizeof($request->items_id);
        $export_date=Carbon::parse($request->receiving_dates)->toDateString();
       /* $export_date->hour=Carbon::now()->hour;
        $export_date->minute=Carbon::now()->minute;
        */
        $export->receiving_dates=$export_date;
        $export->receipt_id=$request->receipt_id;
        $export->exporter_id=$request->exporter_id;
        $export->user_id=Auth::user()->id;

        $export->save();
        foreach ($export->exports_items as $item){
            $export->delete_this_item($item);
        }
        //then store each item
        $ids_array=$request->items_id;
        $quantity_array=$request->items_quantity;
        $size_array=$request->items_size;
        $buying_price_array=$request->items_buying_price;
        $selling_price_array=$request->items_selling_price;
        $discount_array=$request->items_discount;
        $array_size=sizeof($ids_array);
        for($i=0;$i<$array_size;$i++){
            //find this name and check if item with this name added before
            $name=Name::find($ids_array[$i]);
            $item= Item::where("size",$size_array[$i])->where("name_id",$name->id)->first();
            if($item==null){
                $item=new Item();
            }
            $item->name_id=$ids_array[$i];
            $item->size=$size_array[$i];
            $item->buying_price=$buying_price_array[$i];
            $item->selling_price=$selling_price_array[$i];
            $item->discount=$discount_array[$i];
            $item->store_id=DB::table("stores")->first()->id;
        
          //  return $item->get_exist_quantity();

            //check if items not exist so add it

            if($item->the_same_item_exist()==null){
                $item->quantity=$quantity_array[$i];
                $item->save();

            }
            else{
                $name->items()->where("size",$item->size)->update(["quantity"=>$quantity_array[$i]+$item->get_exist_quantity()]);
                $item->save();

            }


            //add this item to export_items llfwateeer

            $item->export_id=$export->id;
            $item->quantity=$quantity_array[$i];

            Exports_item::create($item->toArray());
            


        }

           Exporter_transaction::where("export_id",$export->id)->delete();
            $export_transaction=new Exporter_transaction();
            $export_transaction->paid=$request->paid;
            $export_transaction->paid_at=$request->receiving_dates;

            $export_transaction->user_id=Auth::user()->id;
            $export->exporter_transactions()->save($export_transaction);

            //Payment::where("export_id",$export->id)->delete();

            $payment=new Payment();
            $payment->method="تم تسديدها في الفاتورة";
            $payment->receipt_id=$request->receipt_id;
            $payment->paid_at=$request->receiving_dates;
            $payment->paid=$request->paid;

            $payment->details=$request->details;
            $payment->exporter_id=$request->exporter_id;
            $payment->save();
            event(new exports_added($export));

            $has_id=0;

            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["export"]=$export;
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
            }
    
            

            return redirect('exports');

    }



}
