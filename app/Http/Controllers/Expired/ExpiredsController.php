<?php

namespace App\Http\Controllers\Expired;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Expired;
use App\Item;
use App\Name;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpiredsController extends Controller
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
                $expireds=json_decode(Expired::paginate()->toJson(),true);
                $returned_obj=[];
                $temp_arr=[];
                foreach($expireds["data"] as $item){
                    $item["name"]=Name::find($item["name_id"]);
                    $temp_arr[]=$item;
                }
                $returned_obj["expireds"]=$temp_arr;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://www.productplan.com/uploads/product-spec-template.png","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
          
            } catch (\Throwable $th) {
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
        }
        try {
            $expireds = Expired::all();
            $quantity=Expired::sum("quantity");
            $items_count=sizeof(Expired::pluck("name_id")->unique());
    
    
            $price=0;
            foreach($expireds as $expired){
    
                $price+=$expired->quantity*$expired->buying_price;
    
            }
            return view('expireds.index', compact("expireds","quantity","items_count","price"));

    
    
        } catch (\Throwable $th) {
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
            $item=Item::where("size",$request->size)->where("name_id",$request->name_id)->first();
            $item->quantity=$item->quantity-$request->quantity;
            $item->save();

            $requestData["user_id"]=Auth::id();
            
            $expired=Expired::create($requestData);
            $expired->name=Name::find($expired->name_id);

            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["expired"]=$expired;
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
        /*
        $expired = Expired::findOrFail($id);

        return view('expireds.show', compact('expired'));
        */
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
        /*
        $expired = Expired::findOrFail($id);

        return view('expireds.edit', compact('expired'));
        */
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
        /*
        $requestData = $request->all();
        
        $expired = Expired::findOrFail($id);
        $expired->update($requestData);

        return redirect('expireds')->with('flash_message', 'Expired updated!');
        */
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
        Expired::destroy($id);

        return redirect('expireds')->with('flash_message', 'Expired deleted!');
    }
}
