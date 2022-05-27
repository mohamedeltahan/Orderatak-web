<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        try {
            $permissions=Permission::all();
            if(str_contains(url()->current(), 'api')){
                $returned_obj=[];
                $returned_obj["permissions"]=$permissions;
                return json_encode(["data"=>$returned_obj,"code"=>200,"photo_link"=>"https://www.productplan.com/uploads/product-spec-template.png","video_link"=>"https://www.youtube.com/watch?v=50ttf6SfkTE"],JSON_UNESCAPED_UNICODE);
            }
        } catch (\Throwable $th) {
            if(str_contains(url()->current(), 'api')){
                return json_encode(["code"=>500,"data"=>"حدث خطأ يرجي مراجعة الدعم الفني"]);

            }
            return redirect()->back();

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
    }

    public function GetHomepagePermissions()
    {
        $user=Auth::user();
        $permissions=$user->roles()->first()->permissions;
        $arr=[];

        foreach($permissions as $permission){
            if(str_contains($permission->name, "index") && $permission->name!="caches.index" && $permission->name!="orders.index" && $permission->name!="restoreds.index"){
                $arr[]=$permission->name;

            }

        }
        $arr[]="deliverymen.index";
        $arr[]="districts.index";
        
        return json_encode($arr,JSON_UNESCAPED_UNICODE);

    }
}
