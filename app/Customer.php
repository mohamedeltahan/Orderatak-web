<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

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
    protected $fillable = ['name', 'phone', 'email', 'address', 'facebook_username', 'type',"governorate","customer_link","customer_platform"];



    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
    public function orders(){

        return $this->hasMany("App\Order","customer_id");

    }
    public function phones(){

        return $this->hasMany("App\Phone","customer_id");

    } public function addresses(){

    return $this->hasMany("App\Adress","customer_id");

}
    public function waiting_orders(){

        return $this->orders()->where("state","قيد الانتظار")->get();
    }
    public function get_phones(){
        $phone=explode("-",$this->phone);
        array_pop($phone);
        return $phone;
    }

}
