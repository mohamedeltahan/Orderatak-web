<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Exporter_transaction extends Model
{



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exporter_transactions';

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
    protected $fillable = ['receipt_id', 'paid', 'paid_at', 'details', 'export_id', 'user_id', 'method'];



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
    public function users(){
        return $this->belongsTo("App\User","user_id");
    }
    public function export(){
        return $this->belongsTo("App\Export","export_id");
    }
}
