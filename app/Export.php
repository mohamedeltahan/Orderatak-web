<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Export extends Model
{

    use Traits\Time;
    use Traits\User;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exports';

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
    protected $fillable = ['total_price_before_discount', 'total_price_after_discount', 'discount', 'no_of_items', 'receiving_dates', 'details', 'receipt_id', 'user_id', 'exporter_id'];



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
    public function exporter(){
        return $this->belongsTo("App\Exporter","exporter_id");
    }
    public function exporter_transactions(){
        return $this->hasMany("App\Exporter_transaction","export_id");
    }
    public function exports_items(){
        return $this->hasMany("App\Exports_item","export_id");
    }
    public function items(){
        return $this->hasMany("App\Item","export_id");
    }
    public function rest(){
        return $this->total_price_after_discount-$this->exporter_transactions->sum("paid");

    }
    public function calculate_total(){
        $items_sum=Exports_item::where("exports_id",$this->id)->sum("buying_price");
        $this->total_price_after_discount=$items_sum;
        $this->no_of_items=Exports_item::where("exports_id",$this->id)->count();
        $this->save();


    }

    public function delete_this_item(Exports_item $item){

        $this_export_quantity=$this->exports_items()->where("size",$item->size)->where("name_id",$item->name_id)->sum("quantity");
        $item_in_stock=Item::where("size",$item->size)->where("name_id",$item->name_id)->first();

        if($item_in_stock!=null && $item_in_stock->quantity>=$this_export_quantity){
            $item_in_stock->quantity=$item_in_stock->quantity-$this_export_quantity;
            $item_in_stock->save();

         //  $this->total_price_after_discount=$item->buying_price;
          // $this->no_of_items=$this->no_of_items-1;
         //  $this->save();
            $this->exports_items()->where("size",$item->size)->where("name_id",$item->name_id)->delete();

        }





    }

    static public function CheckExportTotal($buying_price_arr,$quantity_arr)
    {
        $total=0;
        $size=\sizeof($quantity_arr);
        for($i=0;$i<$quantity_arr;$i++){
            $total+=$quantity_arr[$i]*$buying_price_arr[$i];
        }
        return $total;

        
    }

}
