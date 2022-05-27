<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{

    use Traits\Time;
    use Traits\User;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
    protected $fillable = ['total_price_before_discount', 'total_price_after_discount', 'discount', 'no_of_items', 'receiving_date', 'ordering_date', 'receiving_address', 'state', 'completed', 'user_id', 'customer_id',"delivery","prev_total","type","policy_id","details","ship_id","collected","marketer_money","marketer_paid","district_id","ship_districts_id"];



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
    public function customer(){
        return $this->belongsTo("App\Customer","customer_id");
    }
    public function items(){
        return $this->hasMany("App\Order_item","order_id");
    }
    public function user(){
        return $this->belongsTo("App\User","user_id");
    }
    public function ship(){
        return $this->belongsTo("App\Ship","ship_id");
    }
    public function no_of_items(){
        return $this->items()->sum("quantity");
    }

    public function total_price(){
        $temp=0;
        foreach($this->items as $item){
            $temp+=$item->selling_price*$item->quantity;

        }
        return $temp;
    }
    
}
