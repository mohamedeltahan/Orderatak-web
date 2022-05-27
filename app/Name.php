<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Name extends Model
{



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'names';

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
    protected $fillable = ['name', 'code','color'];



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

    public function items(){

        return $this->hasMany("App\Item","name_id");
    }
    public function export_items(){

        return $this->hasMany("App\Exports_item","name_id");
    }
    public function order_items(){

        return $this->hasMany("App\Order_item","name_id");
    }
}
