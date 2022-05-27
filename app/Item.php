<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Item extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

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
    protected $fillable = ['name_id', 'quantity', 'size', 'buying_price', 'selling_price', 'store_id', 'alert_time','alert_quantity', 'discount'];



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

    public function alerts(){
        return $this->hasMany("App\Alert","alert_id");
    }
    public function store(){
        return $this->belongsTo("App\Store","store_id");
    }
    public function name(){
        return $this->belongsTo("App\Name","name_id");
    }

    public function the_same_item_exist(){

        return Item::where("store_id",$this->store_id)->where("name_id",$this->name_id)->where("size",$this->size)->first();
    }
    public function get_exist_quantity(){
        return Item::where("name_id",$this->name_id)->where("size",$this->size)->first()->quantity;
    }

    public function equal_item($item){

        if($this->size==$item->size && $this->name_id==$item->name_id){return true;}
        else return false;
    }
    public function price(){
        return ($this->selling_price)-$this->discount;
    }
}
