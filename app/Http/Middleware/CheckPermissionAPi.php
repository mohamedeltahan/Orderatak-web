<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;


class CheckPermissionAPi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        config(['database.connections.mysql.database' => Auth::user()->account_name]);
        config(['database.connections.mysql.username' => Auth::user()->account_name]);
        config(['database.connections.mysql.password' => "Mohamed1234"]);

        DB::purge('mysql');
        return $next($request);

        /*
        $user=Auth::user();

        $route=Route::current()->getName();
        //this is the permissions which i need to check
        $arr=["exporters.store","exporters.index","exporters.destroy","customers.store","customers.destroy","exports.create",
        "exports.index","exports.destroy","customers.index","orders.create","orders.index","orders.destroy", "setting",
            "paymentsview","items.index","restoreds.index","ships.index","caches.index","most_paying_customers","orders_table"
            /*,"less_paying_customers"
            ,"escaped_customers","waiting_customers","most_profit_items","less_profit_items","most_sell_items","less_sell_items"
            ,"most_available_items","less_available_items"*/


      //  ];
        //dd($user->can($user->roles()->first()->permissions->first()->name));
        // if required route  in permissions array so i check user if have right
     /*   if(in_array($route,$arr)) {
            if ($user->canDo($route)) {
                return $next($request);
            }
            return redirect()->route("home");
        }
        //else i continue request
        else{
            return $next($request);
        }*/
    }
}
