<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ShipDistrict extends Model
{
   // use LogsActivity;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ship_districts';

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
    protected $fillable = ['ship_id', 'district_id', 'cost'];

    

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
      //  return __CLASS__ . " model has been {$eventName}";
    }

    public function district(){
        return $this->belongsTo("App\District","district_id");
    }
    public function ship(){
        return $this->belongsTo("App\Ship","ship_id");
    }
}
