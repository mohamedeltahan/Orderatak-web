<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $roles = Role::where('name', 'LIKE', "%$keyword%")->orWhere('label', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $roles = Role::latest()->paginate($perPage);
        }

        return view('admin.roles.index', compact('roles'));
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
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request,$id)
    {
       /* $this->validate(
            $request,
            [
                'name' => 'required',

            ]
        );*/
        config(['database.connections.mysql.database' => "u311653871_fashion"]);
        config(['database.connections.mysql.username' => "u311653871_fashion"]);
        DB::purge('mysql');
        

        $user=User::find($id);

        
        if($request->filled("password")) {
            $user->password = bcrypt($request->password);

        }
        
        if($request->filled("name")) {
            $user->name = $request->name;

        }
        if($request->filled("phone")) {
            $user->phone = $request->phone;

        }
        
        $role=Role::find(DB::table("role_user")->where("user_id",$user->id)->first()->role_id);
        
        $role->permissions()->detach();

        if ($request->has('permissions')) {

            foreach ($request->permissions as $permission_name) {
                $permission = Permission::find($permission_name);
                $role->givePermissionTo($permission);
            }
        }
        if(DB::table("role_user")->where("user_id",$user->id)->first()==null) {
            $user->assignRole($role->name);
        }

        $user->save();
        
        config(['database.connections.mysql.database' => Auth::user()->account_name]);
        config(['database.connections.mysql.username' => Auth::user()->account_name]);
        DB::purge('mysql');

        $user=User::find($id);

       // return json_encode(DB::table("role_user")->where("user_id",$user->id)->first());
        if($request->filled("password")) {
            $user->password = bcrypt($request->password);

        }
        
        
        if($request->filled("name")) {
            $user->name = $request->name;

        }
        if($request->filled("phone")) {
            $user->phone = $request->phone;

        }
        $role=Role::find(DB::table("role_user")->where("user_id",$user->id)->first()->role_id);

     /*   $arr["name"]= $user->name.$user->account_name;
        $arr["label"]=$user->name.$user->account_name;
        $role = Role::firstOrCreate($arr);
        return $role;*/
      //  return $role->permissions;
         // dd($request->all());
        $role->permissions()->detach();

        if ($request->has('permissions')) {

            foreach ($request->permissions as $permission_name) {
                $permission = Permission::find($permission_name);
                $role->givePermissionTo($permission);
            }
        }

      //  return $role->permissions;
    //   return json_encode(DB::table("role_user")->where("user_id",$user->id)->first());
        if(DB::table("role_user")->where("user_id",$user->id)->first()==null) {
            $user->assignRole($role->name);
        }

        $user->save();

        if(str_contains(url()->current(), 'api')){
            
            $returned_obj=[];
            $returned_obj["user"]=$user;
            $returned_obj["permissions"]=$user->GetSelectedPermissions();
            return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
        }

        //   dd($user->roles()->first()->permissions);
        return redirect()->back();
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return void
     */
    
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required']);

        $user=User::find($id);
        $role = Role::where("user_id",$id)->first();
        $role->update($request->all());
        $role->permissions()->detach();

        if($request->has('permissions')) {
            foreach ($request->permissions as $permission_name) {
                $permission = Permission::whereName($permission_name)->first();
                $role->givePermissionTo($permission);
            }
        }
        if(str_contains(url()->current(), 'api')){
            
            $returned_obj=[];
            $returned_obj["user"]=$user;
            $returned_obj["permissions"]=$user->GetSelectedPermissions();
            return json_encode(["data"=>$returned_obj,"code"=>200],JSON_UNESCAPED_UNICODE);
        }

        return redirect()->back();
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
}
