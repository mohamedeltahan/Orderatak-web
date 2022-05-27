<?php

namespace App\Http\Controllers\District;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\District;
use App\ShipDistrict;
use App\Ship;


use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            if(str_contains(url()->current(), 'api')){
                $districts=District::all();
                return json_encode(["data"=>$districts,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/districts.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
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
        return view('districts.create');
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
            
            $districts=[];
            foreach($request->districts as $d){
            $districts[]=District::firstOrCreate(["name"=>$d]);
            }

            if(str_contains(url()->current(), 'api')){
                return json_encode(["data"=>$districts,"code"=>200],JSON_UNESCAPED_UNICODE);
            }
            

            $tag="districts_tag_button";
            return redirect()->route("setting",["tag"=>$tag]);

        } catch (\Throwable $th) {
            
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->route("setting",["tag"=>$tag]);

        
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
       /* $district = District::findOrFail($id);

        return view('districts.show', compact('district'));*/
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
        $district = District::findOrFail($id);

        return view('districts.edit', compact('district'));
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

            $district = District::findOrFail($id);
            $district->update($requestData);
            if(str_contains(url()->current(), 'api')){
                return json_encode(["data"=>$district,"code"=>200],JSON_UNESCAPED_UNICODE);
            }

            $tag="districts_tag_button";
    
            return redirect()->route("setting",["tag"=>$tag]);
    
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
            return redirect()->route("setting",["tag"=>$tag]);

        }

        //return redirect('districts')->with('flash_message', 'District updated!');
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
            $district=District::destroy($id);
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["state"]=1;
                return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
            }

            $tag="districts_tag_button";
            return redirect()->route("setting",["tag"=>$tag]);       
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
           $tag="districts_tag_button";
    
            return redirect()->route("setting",["tag"=>$tag]);
    
        }
    }


    public function Search(Request $request)
    {
        try {
            $value=$request->value;
            $districts=District::where("name","like","%".$value."%")->get();
           if(str_contains(url()->current(), 'api')){
             $returned_obj=[];
             $returned_obj["districts"]=$districts;
             return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/districts.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
         }
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
        }
        
            
    }
    
    public function get_district_ships($id){
        try {
            $ship_districts_ids=ShipDistrict::where("district_id",$id)->pluck("ship_id")->toArray();
            $men=Ship::whereIn("id",$ship_districts_ids)->where("type","person")->get();
            $company=Ship::whereIn("id",$ship_districts_ids)->where("type","company")->get();
            foreach($men as $man){
                $man->delivery_cost=ShipDistrict::where("ship_id",$man->id)->where("district_id",$id)->first()->cost;
            }
            foreach($company as $com){
                $com->delivery_cost=ShipDistrict::where("ship_id",$com->id)->where("district_id",$id)->first()->cost;
            }

            return json_encode(["data"=>["ships"=>$company,"delivery_men"=>$men],"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/districts.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            
        } catch (\Throwable $th) {
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);

        }
      
      
      
  }
  
  
  
  public function get_district_cost($id,Request $request){
      
      $shipper_id=$request->shipper_id;
      $district_id=$id;
      $ship_district=ShipDistrict::where("ship_id",$shipper_id)->where("district_id",$id)->first();
      if($ship_district!=null){
          return $ship_district->cost;
      }
      else{
          return 0;
      }
      
  }
}
