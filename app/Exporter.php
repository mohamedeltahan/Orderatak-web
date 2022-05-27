<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class exporter extends Model
{



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exporters';

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
    protected $fillable = ['name', 'phone', 'address', 'details'];



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


    public function exports(){
        return $this->hasMany("App\Export","exporter_id");
    }
    public function payments(){
        return $this->hasMany("App\Payment","exporter_id");
    }
    public function state(){
        $sum=0;
        foreach ($this->exports as $export){
            $sum+=$export->rest();
        }
        if($sum==0){return "لا يوجد";}
        if ($sum>0){return "دائن";}
        return "مدين";


    }
    public function get_unpaid_transactions(){
       $exports=$this->exports;
       $arr=[];

       foreach ($exports as $export){
           $rest=$export->rest();
           if($rest!=0){
               $arr[$export->id]=$rest;
           }

       }
       return $arr;



    }
}
