<?php

namespace App\Http\Controllers\Exporter;

use App\Export;
use App\Exporter_transaction;
use App\Http\Middleware\Authenticate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\exporter;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Object_;

class exporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $exporters=exporter::all();
            $exporters_count=$exporters->count();
            $exports_count=Export::all()->count();
            $exports_sum=Export::all()->sum("total_price_after_discount");
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["exporters"]=$exporters;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/exporters.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
    
    
            return view('exporters.index', compact('exporters','exporters_count','exports_count','exports_sum'));
      
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
        return view('exporters.create');
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
        try {
            $requestData = $request->all();
            $exporter=exporter::create($requestData);
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["exporter"]=$exporter;
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
            }
            return redirect('exporters')->with('flash_message', 'exporters added!');

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
        $exporter = exporter::findOrFail($id);

        return view('exporters.show', compact('exporter'));
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

        try {
                
            $requestData = $request->all();
            $exporter = exporter::findOrFail($id);
            $exporter->update($requestData);
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["exporter"]=$exporter;
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
            $exporter=exporter::destroy($id);
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
        


        return redirect()->back();
    }

    public function unpaid_transactions($id){
        $exporter=exporter::find($id);
        return $exporter->get_unpaid_transactions();



    }
    public function exporter_exports($id){

        try {
            $exports = Export::where("exporter_id",$id)->orderBy('created_at', 'desc')->get();
            $tempMonthYear =0;
            $tempDay = 0;
            $exporter=exporter::find($id);
    
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["exporter"]=$exporter;
                $returned_obj["exports"]=$exports;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/exporters.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
    
            //This temp export is added in order to loop through all the orders.
            $temp_export=new Export();
            $temp_export->created_at=Carbon::create(2018);
            $exports->push($temp_export);
            $size = count($exports);
            $has_id=1;
            
    
            return view('exports.index', compact('exports',"size","tempDay","tempMonthYear","has_id","exporter"));
    
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
           }
            return redirect()->back();
            
        }



    }
    public function get_exporter_payments(Request $request,$id){
            
        try {
            $exporters=exporter::all();
            $array_of_objects=[];
            $exporter=exporter::find($id);
            $balance_array=[];



            foreach ($exporter->exports as $export) {
                $export_object=new Object_();
                $export_object->created_at= $export->created_at;

                $export_object->amount = $export->total_price_after_discount;
                $export_object->type = "export";
                $export_object->id = $export->id;
                $export_object->method ="";

                $export_object->details = "";

                $export_object->date = $export->receiving_dates;
                $array_of_objects[] = $export_object;
            /*    if(sizeof($balance_array)!=0){
                    $balance_array[]=$balance_array[sizeof($balance_array)-1]+$export_object->amount;

                }
                else{
                    $balance_array[]=$export_object->amount;

                }*/




            }
        foreach ($exporter->payments as $payment) {
            $transaction_object = new Object_();
            $transaction_object->created_at = $payment->created_at;
            $transaction_object->amount = $payment->paid;
            $transaction_object->type = "transaction";
            $transaction_object->details = $payment->details;
            $transaction_object->method = $payment->method;
            $transaction_object->id = $payment->id;
            $transaction_object->date = $payment->paid_at;
            $array_of_objects[] = $transaction_object;


            //  $balance_array[]=$balance_array[sizeof($balance_array)-1]-$transaction_object->amount;



        }
            $collection_of_items=collect($array_of_objects)->sortBy("date");
        if ($collection_of_items->count()==0){
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["balance_array"]=[];
                $returned_obj["collection_of_items"]=[];
                return json_encode(["data"=>$returned_obj]);
            }
            return redirect()->route("paymentsview");
        }
            $first_item=$collection_of_items->shift();
            $balance_array=[];
            if($first_item->type=="transaction"){
                $balance_array[]=$first_item->amount*-1;
            }
            else{
                $balance_array[]=$first_item->amount;
            }
            $last_type=$first_item->type;

            foreach ($collection_of_items as $item) {
                if($item->type=="export") {
                    $balance_array[] = $balance_array[sizeof($balance_array) - 1] + $item->amount;
                    
                }
                else{
                    $balance_array[]=$balance_array[sizeof($balance_array)-1]-$item->amount;
                }

            }
          $collection_of_items->prepend($first_item);


            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["balance_array"]=$balance_array;
                $returned_obj["collection_of_items"]=$collection_of_items;
                return json_encode(["data"=>$returned_obj]);
            }
            return view("exporter_payment",compact("exporters","collection_of_items","balance_array","exporter"));



        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
           }
            return redirect()->back();

        }
           
       
    }





    public function payments(){
        $exporters=exporter::all();

        return view("payments.index",compact("exporters"));

    }

    public function pay(Request $request){

        try {
            $exporter=exporter::find($request->exporter_id);
            $exports=$exporter->exports;
            $unpaid_exports=[];
            foreach ($exports as $export){
                if($export->rest()!=0){
                    $export->rest=$export->rest();
                    $unpaid_exports[]=$export;

                }

            }
            //convert to collect to sort them
            $exports_collect=collect($unpaid_exports);
            $exports_collect=$exports_collect->sortBy("rest");
            $paid=$request->paid;
            foreach ($exports_collect as $e){
                $exporter_transaction=new Exporter_transaction();
                $exporter_transaction->receipt_id=$request->receipt_id;
                $exporter_transaction->paid_at=$request->date;
                $exporter_transaction->details=$request->details;
                $exporter_transaction->method=$request->all()["method"];
                $exporter_transaction->user_id=Auth::id();
                if($paid>$e->rest){
                    $exporter_transaction->paid=$e->rest;
                    $paid-=$e->rest;

               }
                elseif($paid<$e->rest){
                    $exporter_transaction->paid=$paid;
                    $paid=0;

                }
                else{
                    return redirect()->back();

                }



            $e->exporter_transactions()->save($exporter_transaction);



          } 
          if($request->paid!=0){
            $payment=new Payment();
            $payment->method=$request->all()["method"];
            $payment->receipt_id=$request->receipt_id;
            $payment->paid_at=$request->date;
            $payment->paid=$request->paid;

            $payment->details=$request->details;
            $payment->exporter_id=$request->exporter_id;
            $payment->save();
          }
          if(str_contains(url()->current(), 'api')){
            $returned_obj=[];
            $returned_obj["payment"]=$payment;
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

}
