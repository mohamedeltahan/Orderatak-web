<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Restored extends Model
{



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'restoreds';

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
    protected $fillable = ['name_id', 'customer_id',"order_id", 'user_id', 'reason',"size","quantity","confirmed"];



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

    public function get_customer(){
        return Order::find($this->order_id)->customer;
    }
    public function user(){
        return $this->belongsTo("App\User","user_id");
    }
    public function name(){
        return $this->belongsTo("App\Name","name_id");
    }
}
