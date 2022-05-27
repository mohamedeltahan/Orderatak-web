<?php

namespace App\Listeners;

use App\Events\exports_added;
use App\Unavailable_alert;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class exports_added_listener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(exports_added $event)
    {
        //
        $export=$event->export;
        foreach ($export->exports_items as $item){

            $alerts=Unavailable_alert::where("size",$item->size)->where("name_id",$item->name_id)->get();
            if($alerts->count()!=0){
                foreach ($alerts as $alert)
                    if ($alert->state=="not_seen"){$alert->state="notify";
                        $alert->save();
                    }

            }

        }
    }
}
