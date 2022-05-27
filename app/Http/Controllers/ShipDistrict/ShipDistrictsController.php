<?php

namespace App\Http\Controllers\ShipDistrict;

use App\District;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ShipDistrict;
use Illuminate\Http\Request;

class ShipDistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request,$id)
    {
        try {
            $ship_districts=ShipDistrict::where("ship_id",$id)->get();
            foreach($ship_districts as $district){
                $district->name=District::find($district->district_id)->name;
            }
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["districts"]=$ship_districts;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://www.productplan.com/uploads/product-spec-template.png","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
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
        return view('ship-districts.create');
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
           
        $districts_array=$request->districts;
        $cost_array=$request->cost;
        $temp_arr=[];
         
        for($i=0; $i<sizeof($cost_array); $i++)
        {
            $requestData["ship_id"]=$request->ship_id;
            $requestData["district_id"]=$districts_array[$i];
            $requestData["cost"]=$cost_array[$i];
            $ship_district=ShipDistrict::where("district_id",$districts_array[$i])->where("ship_id",$request->ship_id)->first();
            if($ship_district==null){
                $temp_arr[]=ShipDistrict::create($requestData);
            }
            else{
                $ship_district->cost=$cost_array[$i];
                $ship_district->save();
                $temp_arr[]=$ship_district;
            }
        }
        if(str_contains(url()->current(), 'api')){
            $returned_obj=[];
            $returned_obj["districts"]=$temp_arr;
            return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
        }
        
            return redirect()->route("ship_orders",["id"=>$request->ship_id,"tag"=>"ship-districts-tab"]);

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
            $ship_district = ShipDistrict::find($id);
            $ship_district->name = District::find($ship_district->district_id)->name;
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["district"]=$ship_district;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://www.productplan.com/uploads/product-spec-template.png","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
        } catch (\Throwable $th) {
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
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
        $shipdistrict = ShipDistrict::findOrFail($id);

        return view('ship-districts.edit', compact('shipdistrict'));
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
        $shipdistrict = ShipDistrict::findOrFail($id);
        $shipdistrict->update($requestData);
        return redirect()->back();
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
            ShipDistrict::destroy($id);
            
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
        }
    }
}
