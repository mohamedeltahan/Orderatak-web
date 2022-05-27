<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Store;
use App\Name;

use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $stores=Store::all();

            foreach($stores as $store){
                $store->no_of_items=Item::where("store_id",$store->id)->count();
            }
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["stores"]=$stores;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/stores.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
            return view('stores.index', compact('stores'));
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('stores.create');
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
           //   $requestData["name"]=str_replace(" ","-",$requestData["name"]);
   
           $store=Store::create($requestData);
   
           if(str_contains(url()->current(), 'api')){
               $returned_obj=[];
               $returned_obj["store"]=$store;
               return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
           }
   
           $tag="stores_tag_button";
           
   
           return redirect()->route("setting",["tag"=>$tag]);
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
        $store = Store::find($id);
        if(str_contains(url()->current(), 'api')){
            $returned_obj=[];
            $returned_obj["store"]=$store;
            return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/stores.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
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
        $store = Store::findOrFail($id);

        return view('stores.edit', compact('store'));
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
            // $requestData["name"]=str_replace(" ","-",$requestData["name"]);
    
            $store = Store::findOrFail($id);
            $store->update($requestData);
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["stores"]=$store;
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
            }
    
            $tag="stores_tag_button";
            return redirect()->route("setting",["tag"=>$tag]);
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            $tag="stores_tag_button";
            return redirect()->route("setting",["tag"=>$tag]);
       
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
            Store::destroy($id);
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["state"]=1;
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
            }

            $tag="stores_tag_button";
   
            return redirect()->route("setting",["tag"=>$tag]);
        
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back();
       
        }
    }

    public function GetStoreItems(Request $request,$id)
    {
        try {
            $store=Store::find($id);
            $items=Item::where("store_id",$id)->get();
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["store"]=$store;
                $temp_arr=[];
                foreach($items as $item){
                    $item->name=Name::find($item->name_id);
                }
            $returned_obj["items"]=$items;
            return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/stores.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
        }
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->back();
        }
        

    }
}
