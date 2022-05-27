<?php

namespace App\Http\Controllers\Name;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Name;
use Illuminate\Http\Request;

class NamesController extends Controller
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
                $names=Name::paginate();
                return json_encode(["data"=>["names"=>$names],"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/names.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
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
        return view('names.create');
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
           $name=Name::create($requestData);
           if(str_contains(url()->current(), 'api')){
               return json_encode(["data"=>["name"=>$name],"code"=>200],JSON_UNESCAPED_UNICODE);
           }
   
           $tag="items_tag_button";
   
           return redirect()->route("setting",["tag"=>$tag]);
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
            $name = Name::find($id);
            if(str_contains(url()->current(), 'api')){
                return json_encode(["data"=>["name"=>$name],"code"=>200,"photo_link"=>"https://orderatak.com/system/public_html/help_photos/names.jpg","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
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

        try {
            $requestData = $request->all();

            $name = Name::findOrFail($id);
          //  $requestData["name"]=str_replace(" ","-",$requestData["name"]);
    
            $name->update($requestData);
    
            if(str_contains(url()->current(), 'api')){
                return json_encode(["data"=>["name"=>$name],"code"=>200],JSON_UNESCAPED_UNICODE);
            }
    
            $tag="items_tag_button";
    
            return redirect()->route("setting",["tag"=>$tag]);
        
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
            }
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
            
            Name::destroy($id);
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

    public function NamesSelectList(Request $request)
    {
        $names=Name::get(["name","id"])->toArray();
        return json_encode(["data"=>["names"=>$names],"code"=>200],JSON_UNESCAPED_UNICODE);
    }
}
