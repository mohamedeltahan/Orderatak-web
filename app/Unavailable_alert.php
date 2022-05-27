<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Unavailable_alert extends Model
{



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'unavailable_alerts';

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
    protected $fillable = ['state', 'order_id', 'user_id', 'item_id'];



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
    public function order(){
        return $this->belongsTo("App/Order","order_id");

    }
    public function item(){
        return $this->belongsTo("App/Item","Item_id");

    }
}
