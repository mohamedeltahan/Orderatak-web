<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable,HasRoles;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',"account_name","account_type","package","id","account_name","account_type","no_of_customers",
        "no_of_orders","no_of_users","currency","country","receipt_name","policy_id","ship_id","api_token","receipt_message","phone","receipt_phone","photo_link","email","platform","social_link"
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany("App\Order","user_id");
    }
    public function exports(){
        return $this->hasMany("App\Export","user_id");
    }
    public function alerts(){
        return $this->hasMany("App\Alert","user_id");
    }
    public function unavailabel_alert(){
        return $this->hasMany("App\Unavailable_alert","user_id");
    }
    public function cashes(){
       return $this->hasMany("App\Cashe","user_id");

    }
    public function canDo($permission_name){
        $permission=Permission::where("name",$permission_name)->first();
        return $this->hasRole($permission->roles);

    }

    public function GetSelectedPermissions()
    {
        $user_role=DB::table("role_user")->where("user_id",$this->id)->first();
        $user_permissions=DB::table("permission_role")->where("role_id",$user_role->role_id)->pluck("permission_id")->toArray();
        $permissions=Permission::all();
        foreach($permissions as $permission){
            if(in_array($permission->id,$user_permissions)){
                $permission->selected=1;
            }
            else{
                $permission->selected=0;

            }

        }
        return $permissions;
    }


}
