<?php

namespace App\Http\Controllers\Item;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\Name;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $items=null;
            $flag_that_all_items_are_passed="true";
    
           if($request->has("store_id")){
               $items=Item::where("store_id",$request->store_id)->paginate();
               $flag_that_all_items_are_passed=$request->store_id;
           }
           else{
               $items=Item::all();
               if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $temp_arr=[];
                foreach($items as $item){
                    $item->name=Name::find($item->name_id);
                    $temp_arr[]=$item;
                }
                $returned_obj["items"]=$items;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/items.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
               }
    
           }
           $items_count=$items->count();
           $items_sum=$items->sum("quantity");
          // $items_price=$items->sum("total_price_after_discount");
           $names=Name::all();
           $items_overall_quantity=$items->sum("quantity");
    
            $items_overall_price=0;
            foreach ($items as $item){
    
                $items_overall_price+=($item->buying_price*$item->quantity);
            }
            $stores=Store::all();
          //  dd($flag_that_all_items_are_passed===1);
          //dd(\gettype($stores->first()->id));
    
            return view('items_in_store', compact('items',"names","items_overall_price","items_overall_quantity","items_count",'items_sum','stores','flag_that_all_items_are_passed'));
      
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
        return view('items.create');
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
            $name=Name::find($request->name_id);
            $item= new Item();
            $item->name_id=$name->id;
            $item->quantity=$request->quantity;
            $item->size=$request->size;
            $item->buying_price=$request->buying_price;
            $item->selling_price=$request->selling_price;
            if($request->filled("store_id")){
                $item->store_id=$request->store_id;
    
            }
            else{
                $item->store_id=Store::all()[0]->id;
    
            }
    
    
    
            //check if items not exist so add it
    
            if($item->the_same_item_exist()==null){
            
                $item->save();
    
            }
            else{
                $name->items()->where("size",$item->size)->update(["quantity"=>$item->quantity+$item->get_exist_quantity(),"selling_price"=>$item->selling_price,"buying_price"=>$item->buying_price]);
    
            }
    
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $item->name=Name::find($item->name_id);
                $returned_obj["item"]=$item;
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
            $item = Item::find($id);
            $item->name=Name::find($item->name_id);
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["item"]=$item;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/items.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
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
        $item = Item::findOrFail($id);

        return view('items.edit', compact('item'));
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
            $item = Item::findOrFail($id);
            $item->update($requestData);
            $returned_obj=[];
            $returned_obj["item"]=$item;
            return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
       
    
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
        Item::destroy($id);
        if(str_contains(url()->current(), 'api')){
           
            return json_encode(["data"=>["state"=>1],"code"=>200],JSON_UNESCAPED_UNICODE);
        }

        return redirect('items')->with('flash_message', 'Item deleted!');
    }
 
    public function shop(Request $request)
    { 
        $no_of_results=8;
        $items = Item::all();
        foreach($items as $item){
            $item->color=$item->name->color;
            $item->brand_name=$item->name->name;

        }
     /*   $items=$items->groupBy("brand_name");
        foreach($items as $key=>$value){
           // $value=$value->groupBy("color");
          //  $value->x=$value->groupBy("color");
       
          $items[$key]=$value->groupBy("color");
      
        }*/
        
        $items=$items->unique("brand_name");
        $ids = $items->pluck("id")->toArray();
        $no_of_pages=sizeof($ids)/$no_of_results;
        $pages=[];
        for($i=0; $i<$no_of_pages; $i++){
            $index=$i+1;
            $selected_ids=array_slice($ids,(($i)*$no_of_results),($no_of_results));
            $items = Item::whereIn("id",$selected_ids)->get();
            $pages[$index]=$items;
        }
        
        return view("shop",compact("pages","no_of_pages"));
       

        
        /*
        $no_of_results=8;
        $ids = Item::all()->pluck("id")->toArray();
        $no_of_pages=sizeof($ids)/$no_of_results;
        $pages=[];
        for($i=0; $i<$no_of_pages; $i++){
            $index=$i+1;
            $selected_ids=array_slice($ids,(($i)*$no_of_results),($no_of_results));
            $items = Item::whereIn("id",$selected_ids)->get();
            $pages[$index]=$items;
        }
           dd($pages);
        
        return view("shop",compact("pages","no_of_pages"));
        */
     }


}
