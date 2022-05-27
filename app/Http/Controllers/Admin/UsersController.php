<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Name;
use App\Order;
use App\Permission;
use App\Role;
use App\User;
use App\Ship;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $users = User::all();
        if (str_contains(url()->current(), 'api')) {
            $returned_obj = [];
            $returned_obj["users"] = $users;
            return json_encode(["data" => $returned_obj, "code" => 200, "photo_link" => "https://orderatak.com/system/public_html/help_photos/users.jpg", "video_link" => "https://www.youtube.com/watch?v=50ttf6SfkTE"], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        /* $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        return view('admin.users.create', compact('roles'));*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'name' => 'required',
                'password' => 'required',
                'permissions' => 'required'
            ]
        );


        $data = $request->except(['password', "ship_id"]);

        $data["api_token"] = Str::random(60);



        config(['database.connections.mysql.database' => "u311653871_dashboard"]);
        config(['database.connections.mysql.username' => "u311653871_dashboard"]);
        DB::purge('mysql');


        $data['password'] = bcrypt($request->password);
        $data["account_name"] = Auth::user()->account_name;
        $data["account_type"] = Auth::user()->account_type;
        $data["no_of_users"] = Auth::user()->no_of_users;
        $data["no_of_customers"] = Auth::user()->no_of_customers;
        $data["no_of_orders"] = Auth::user()->no_of_orders;
        $data["currency"] = Auth::user()->currency;
        $data["country"] = Auth::user()->country;
        $data["receipt_name"] = Auth::user()->receipt_name;
        $data["policy_id"] = Auth::user()->policy_id;

        $data["receipt_message"] = Auth::user()->receipt_message;
        $data["receipt_phone"] = Auth::user()->receipt_phone;
        $data["photo_link"] = Auth::user()->photo_link;




        $user = User::create($data);

        $arr["name"] = $user->name . $data["account_name"];
        $arr["label"] = $user->name . $data["account_name"];

        $data["id"] = $user->id;





        $role = Role::firstOrCreate($arr);
        foreach ($request->permissions as $permission) {
            $p = Permission::find($permission);
            
            if(DB::table("permission_role")->where("role_id",$role->id)->where("permission_id",$p->id)->first()==null){
                $role->givePermissionTo($p);
            }
        }
        $user->assignRole($role->name);
        config(['database.connections.mysql.database' => Auth::user()->account_name]);
        config(['database.connections.mysql.username' => Auth::user()->account_name]);

        DB::purge('mysql');

        $arr["name"] = $user->name;
        $arr["label"] = $user->name;
        $arr["name"] = $user->name . $data["account_name"];
        $arr["label"] = $user->name . $data["account_name"];
        $data["account_name"] = Auth::user()->account_name;
        $data["account_type"] = Auth::user()->account_type;
        $data["no_of_users"] = Auth::user()->no_of_users;
        $data["no_of_customers"] = Auth::user()->no_of_customers;
        $data["no_of_orders"] = Auth::user()->no_of_orders;
        $data["currency"] = Auth::user()->currency;
        $data["country"] = Auth::user()->country;
        $data["receipt_name"] = Auth::user()->receipt_name;
        $data["policy_id"] = Auth::user()->policy_id;

        $data["receipt_message"] = Auth::user()->receipt_message;
        $data["receipt_phone"] = Auth::user()->receipt_phone;
        $data["photo_link"] = Auth::user()->photo_link;




        if ($request->filled("ship_id") && $request->ship_id != 0) {
            $ship = Ship::find($request->ship_id);
            $data["ship_id"] = $ship->id;
        }

        $user = User::create($data);




        $role = Role::firstOrCreate($arr);
        foreach ($request->permissions as $permission) {
            $p = Permission::find($permission);
         if(DB::table("permission_role")->where("role_id",$role->id)->where("permission_id",$p->id)->first()==null){
            $role->givePermissionTo($p);
         }
        }
        $user->assignRole($role->name);
        //  DB::setDefaultConnection('tenant');

        $tag = "users_tag_button";

        return redirect()->route("setting", ["tag" => $tag]);
    }
    public function get_permission($id)
    {
        try {
            $role = Role::find(DB::table("role_user")->where("user_id", $id)->first()->role_id);
            return json_encode(["code" => 200, "data" => $role->permissions, "photo_link" => "https://orderatak.com/system/public_html/help_photos/users.jpg", "video_link" => "https://www.youtube.com/watch?v=50ttf6SfkTE"], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["code" => 500, "data" => "حدث خطأ يرجي مراجعة الدعم الفني"]);
        }
    }

    public function AddNewUser(Request $request)
    {

        $messages = [
            'name.required' => 'يرجي كتابة اسم مناسب  ',
            'name.unique' => 'يرجي كتابة اسم غير متكرر',
            'password' => 'يرجي مراجعة كلمة السر',
            'permissions' => 'يرجي اختيار صلاحيات',
        ];


        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', "unique:users"],
                'password' => 'required',
                'permissions' => 'required',

            ],
            $messages
        );
        if ($validator->fails()) {
            return json_encode(["code" => 400, "message" => $validator->errors()->first()], JSON_UNESCAPED_UNICODE);
        }
        $data = $request->except(['password', "ship_id"]);
        $data["api_token"] = Str::random(60);
        $user = null;
        try {
            config(['database.connections.mysql.database' => "u311653871_dashboard"]);
            config(['database.connections.mysql.username' => "u311653871_dashboard"]);
            DB::purge('mysql');
            $data['password'] = bcrypt($request->password);
            $data["account_name"] = Auth::user()->account_name;
            $data["account_type"] = Auth::user()->account_type;
            $data["no_of_users"] = Auth::user()->no_of_users;
            $data["no_of_customers"] = Auth::user()->no_of_customers;
            $data["no_of_orders"] = Auth::user()->no_of_orders;
            $data["currency"] = Auth::user()->currency;
            $data["country"] = Auth::user()->country;
            $data["receipt_name"] = Auth::user()->receipt_name;
            $data["policy_id"] = Auth::user()->policy_id;

            $user = User::create($data);


            $arr["name"] = $user->name . $data["account_name"];
            $arr["label"] = $user->name . $data["account_name"];

            $role = Role::firstOrCreate($arr);
            foreach ($request->permissions as $permission) {
                $p = Permission::find($permission);
                $role->givePermissionTo($p);
            }


            $user->assignRole($role->name);
        } catch (\Throwable $th) {
            if ($user != null) {
                User::destroy($user->id);
            }
            if ($role != null) {
                Role::destroy($role->id);
            }
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }


        try {

            config(['database.connections.mysql.database' => Auth::user()->account_name]);
            config(['database.connections.mysql.username' => Auth::user()->account_name]);
            DB::purge('mysql');


            $arr["name"] = $user->name . $data["account_name"];
            $arr["label"] = $user->name . $data["account_name"];
            $data["account_name"] = Auth::user()->account_name;
            $data["account_type"] = Auth::user()->account_type;
            $data["no_of_users"] = Auth::user()->no_of_users;
            $data["no_of_customers"] = Auth::user()->no_of_customers;
            $data["no_of_orders"] = Auth::user()->no_of_orders;
            $data["currency"] = Auth::user()->currency;
            $data["country"] = Auth::user()->country;
            $data["receipt_name"] = Auth::user()->receipt_name;
            $data["policy_id"] = Auth::user()->policy_id;


            if ($request->filled("ship_id") && $request->ship_id != 0) {
                $ship = Ship::find($request->ship_id);
                $data["ship_id"] = $ship->id;
            }
            $data["id"] = $user->id;

            $user = User::create($data);
            $role = Role::firstOrCreate($arr);
            foreach ($request->permissions as $permission) {
                $p = Permission::find($permission);
                $role->givePermissionTo($p);
            }
            $user->assignRole($role->name);
        } catch (\Throwable $th) {
            User::destroy($user->id);
            if ($user != null) {
                User::destroy($user->id);
            }
            if ($role != null) {
                Role::destroy($role->id);
            }
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }


        if (str_contains(url()->current(), 'api')) {
            $returned_obj = [];
            $returned_obj["user"] = $user;
            return json_encode(["data" => $returned_obj, "code" => 200], JSON_UNESCAPED_UNICODE);
        }
    }

    public function get_user_permission($id)
    {
        try {
            $user = User::find($id);
            $permissions = $user->GetSelectedPermissions();
            return json_encode(["data" => $permissions, "code" => 200, "photo_link" => "https://orderatak.com/system/public_html/help_photos/users.jpg", "video_link" => "https://www.youtube.com/watch?v=50ttf6SfkTE"], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }
    }

    public function get_auth_user_permission()
    {
        try {
            $role = Role::find(DB::table("role_user")->where("user_id", Auth::id())->first()->role_id);
            return json_encode(["data" => $role->permissions, "code" => 200, "photo_link" => "https://orderatak.com/system/public_html/help_photos/users.jpg", "video_link" => "https://www.youtube.com/watch?v=50ttf6SfkTE"], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }
    }
    public function get_permissions_with_auth_user_permission()
    {

        try {
            $user = Auth::user();
            $permissions = $user->GetSelectedPermissions();
            return json_encode(["data" => $permissions, "code" => 200, "photo_link" => "https://orderatak.com/system/public_html/help_photos/users.jpg", "video_link" => "https://www.youtube.com/watch?v=50ttf6SfkTE"], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {  /*
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    { /*
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        $user = User::with('roles')->select('id', 'name', 'email')->findOrFail($id);
        $user_roles = [];
        foreach ($user->roles as $role) {
            $user_roles[] = $role->name;
        }

        return view('admin.users.edit', compact('user', 'roles', 'user_roles'));
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        /*  $this->validate(
            $request,
            [
                'name' => 'required',
                //'email' => 'required|string|max:255|email|unique:users,email,' . $id,
                'password' => 'required'
            ]
        );
          */
        try {

            $data = $request->except(['password', 'api_token']);
            if ($request->has('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $user = User::find($id);
            $user->update($data);

            config(['database.connections.mysql.database' => "u311653871_dashboard"]);
            config(['database.connections.mysql.username' => "u311653871_dashboard"]);
            DB::purge('mysql');
            $user = User::find($id);
            $user->update($data);
            if (str_contains(url()->current(), 'api')) {
                $returned_obj = [];
                $returned_obj["user"] = $user;
                return json_encode(["data" => $returned_obj, "code" => 200], JSON_UNESCAPED_UNICODE);
            }



            return redirect()->back();
        } catch (\Throwable $th) {
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */


    public function update_auth_user(Request $request)
    {
        /* $this->validate(
            $request,
            [
                'name' => 'required',
                //'email' => 'required|string|max:255|email|unique:users,email,' . $id,
               // 'password' => 'required'
            ]
        );*/
        try {
            $data = $request->except(['password', 'api_token']);
            if ($request->has('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $user = Auth::user();

            config(['database.connections.mysql.database' => "u311653871_dashboard"]);
            config(['database.connections.mysql.username' => "u311653871_dashboard"]);
            DB::purge('mysql');
            $user = User::find($user->id);
            $user->update($data);

            /* $user->roles()->detach();
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }*/
            if (str_contains(url()->current(), 'api')) {
                $returned_obj = [];
                $returned_obj["user"] = $user;
                return json_encode(["data" => $returned_obj, "code" => 200], JSON_UNESCAPED_UNICODE);
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
        }
    }
    public function destroy($id)
    {
        if (str_contains(url()->current(), 'api')) {

            try {

                User::destroy($id);
                config(['database.connections.mysql.database' => "u311653871_dashboard"]);
                config(['database.connections.mysql.username' => "u311653871_dashboard"]);
                DB::purge('mysql');
                User::destroy($id);            
             return json_encode(["data" => ["state" => 1]], JSON_UNESCAPED_UNICODE);
            } catch (\Throwable $th) {
                return json_encode(["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"], JSON_UNESCAPED_UNICODE);
            }
        }
        try {
            User::destroy($id);
            
            config(['database.connections.mysql.database' => "u311653871_dashboard"]);
            config(['database.connections.mysql.username' => "u311653871_dashboard"]);
            DB::purge('mysql');
            User::destroy($id);

            return redirect()->back()->withErrors("تم حذف المستخدم");
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("حدثت مشكلة يرجي مراجعة الدعم الفن");
        }
    }


    public function Orders(Type $var = null)
    {
        try {

            $orders = Order::where("user_id", Auth::id())->paginate();
            $orders = json_decode($orders->toJson(), true);

            return json_encode(["data" => ["orders" => $orders], "code" => 200, "photo_link" => "https://orderatak.com/system/public_html/help_photos/users.jpg", "video_link" => "https://www.youtube.com/watch?v=50ttf6SfkTE"], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["error" => ["code" => 500, "message" => "حدث خطأ يرجي مراجعة الدعم الفني"]]);
        }
    }

    public function edit_profile(Request $request)
    {

        try {
            $data = $request->except(["api_token", "ipinfo"]);
            if ($request->has('photo_link')) {
                $file = $request->file('photo_link');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                Storage::disk('public')->putFileAs("receipts-photos", $file, $filename);
                $data["photo_link"] = $filename;
            }
            $ids=User::pluck("id")->toArray();
            User::whereIn("id", $ids)->update($data);

            config(['database.connections.mysql.database' => "u311653871_dashboard"]);
            config(['database.connections.mysql.username' => "u311653871_dashboard"]);
            DB::purge('mysql');
            User::whereIn("id", $ids)->update($data);

            return json_encode(["data" => ["user" => Auth::user()], "code" => 200], JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return json_encode(["error" => ["code" => 500, "message" => "حدثت مشكلة يرجي مراجعة الدعم الفني"]]);
        }
    }
    public function get_user_details($id)
    {
        $user = User::find($id);
        return json_encode(["data" => ["user" => $user], "code" => 200], JSON_UNESCAPED_UNICODE);
    }
    
    
    public function CreateGuest(Request $request){
         $data = $request->except('password');


        $data['password'] = bcrypt($request->password);
        $data["account_name"]="u311653871_fashion";
        $data["account_type"]="u311653871_fashion";
        $data["no_of_users"]=100;
        $data["no_of_customers"]=100;
        $data["no_of_orders"]=100;
        $data["currency"]="جم";
        $data["country"]="مصر";
        $data["api_token"]=Str::random(60);
        $data["phone"]="00000000000";
        $data["receipt_phone"]=$request->name;
        $data["receipt_message"]=$request->name;
        $data["email"]="email@email.com";
        $data["platform"]="platform";
        $data["social_link"]="social_link";
        $data["photo_link"]="1635254780.jpg";
        
        $data["receipt_name"]=$request->name;
        $data["policy_id"]=100;
        

        //$data["package"]=$request->package;
        $user = User::create($data);

        $arr["name"]= Str::random(20);
        $arr["label"]=Str::random(20);
        $data["id"]=$user->id;




        $role = Role::firstOrCreate($arr);
        foreach (Permission::pluck("id") as $permission){
            $p=Permission::find($permission);
            $role->givePermissionTo($p);
        }
        $user->assignRole($role->name);
        config(['database.connections.mysql.database' => $data["account_name"]]);
        config(['database.connections.mysql.username' => $data["account_name"]]);

        DB::purge('mysql');

        $user = User::create($data);




        $role = Role::firstOrCreate($arr);
        foreach (Permission::pluck("id") as $permission){
            $p=Permission::find($permission);
            $role->givePermissionTo($p);
        }
        $user->assignRole($role->name);
        return json_encode(["token"=>$user->api_token,"user"=>$user]);

       
    }
}
