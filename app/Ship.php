<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Ship extends Model
{



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ships';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'phone', 'address','type','start_hour','end_hour',"social_account"];



    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
       // return __CLASS__ . " model has been {$eventName}";
    }
    public function get_phones(){
        $phone=explode("-",$this->phone);
        return $phone;
    }
    public function orders(){
        return $this->hasMany("App\Order","ship_id");
    }

    public function payments(){
        return $this->hasMany("App\ShipPayment","ship_id");
    }

    public function shipdistricts(){
        return $this->hasMany("App\ShipDistrict","ship_id");
    }

    public function holding_items(){
        $orders=Order::where("ship_id",$this->id)->get();
        
        
    }
    public function GetDeservedAmount(Type $var = null)
    {
        return Order::where("state","تم الشحن")->where("ship_id",$this->id)->sum("total_price_after_discount");
    }

    public function Check_District($id)
    {
        try {
            return json_encode(ShipDistrict::where("ship_id",$this->id)->where("district_id",$id)->exists());

        } catch (\Throwable $th) {
            return json_encode(["code"=>500,"message"=>"حدثت مشكلة يرجي مراجعة الدعم الفني"],JSON_UNESCAPED_UNICODE);
        }
    }
    
    

}
