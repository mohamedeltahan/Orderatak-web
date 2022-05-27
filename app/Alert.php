<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Alert extends Model
{




    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alerts';

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
    protected $fillable = ['type', 'state', 'item_id', 'user_id'];



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
    public function user(){
        return $this->belongsTo("App\User","user_id");
    }

    public function item(){
        return $this->belongsTo("App\Item","item_id");

    }
}
