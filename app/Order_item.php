<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order_item extends Model
{



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_items';

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
    protected $fillable = ['name_id', 'quantity', 'size', 'selling_price', 'buying_price', 'discount', 'order_id'];



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
    public function name(){
        return $this->belongsTo("App\Name","name_id");
    }
    public function total_price(){
        return (($this->selling_price-$this->discount)*$this->quantity);
    }
    public function price(){
        return ($this->selling_price);
    }

}
