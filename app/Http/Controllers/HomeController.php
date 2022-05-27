<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\Permission;
use App\Store;
use App\Ship;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Object_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    public function UserDetails()
    {
        return Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
       /*config(['database.connections.mysql.database' => Auth::user()->account_name]);
       config(['database.connections.mysql.username' => Auth::user()->account_name]);
       config(['database.connections.mysql.password' => "Mohamed1234"]);
       DB::purge('mysql');*/
        
       $user=User::find(Auth::user()->id);

        
        
        if($user->ship_id!=null){
             return redirect()->route("orders_table");
         }   

        $wait=Order::where("state","انتظار")->count();
        $confirm=Order::where("state","تم التاكيد")->count();
        $charge=Order::where("state","تم الشحن")->count();
        //$restore=Order::where("state","مرتجع")->orwhere("state","مرتجع جزئي")->count();
        $restore=Order::where("state","مرتجع")->count();
        $users_sales=[];
        $users=User::all();
        foreach ( $users as $user){
            $obj=new  Object_();
            $obj->name=$user->name;
            $obj->sales=$user->orders()->count();
            $users_sales[]=$obj;

        }
        $monthly_sales=[];
        $months=[1,2,3,4,5,6,7,8,9,10,11,12];
        foreach ($months as $month){

            $monthly_sales[]=Order::whereMonth("created_at","=",$month)->sum("total_price_after_discount");

        }
        $Auth_user_name=Auth::user()->name;

        $items_count=Item::orderBy("quantity","desc")->limit(4)->get();

        return view("homepage",compact("wait","confirm","charge","restore","users_sales","monthly_sales","Auth_user_name","items_count"));
    }
    public function setting(Request $request){

        $tag=null;
        $names=\App\Name::all();
        $districts=\App\District::all();
        $permissions=Permission::all();
        $users=User::all();
        $stores=Store::all();
        foreach ($districts as $district){
            $district->link=route("districts.update",$district->id);
        }
        if($request->has("tag")){
            $tag=$request->tag;
        }

        $ships=Ship::all();
        return view('setting',compact("names","districts","permissions","users","tag","stores","ships"));    }
}
