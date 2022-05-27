<?php

namespace App\Exports;


use App\Export;
use App\Order;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($start,$end,$ship_id,$state)
    {
        $this->start=$start;
        $this->end=$end;
        $this->ship_id=$ship_id;
        $this->state=$state;

    }

    public function view(): \Illuminate\Contracts\View\View
    {
        $from = $this->start;
        $to = $this->end;
        $orders=null;

        if($from!=null && $to!=null) {
            $orders = Order::where("state",$this->state)->where("ship_id",$this->ship_id)->where("created_at", ">=",$from)->where("created_at","<=",$to)->get();

        }
        else{
            $orders = Order::where("state",$this->state)->where("ship_id",$this->ship_id)->get();
        }

        $all_orders_quantity=0;
        foreach ($orders as $order){

            $all_orders_quantity+=$order->items()->sum("quantity");
        }


            return view('table', [
                'orders' => $orders,
                'all_orders_quantity' => $all_orders_quantity,
            ]);

    }

    /*public function query()
    {
        return Order::query();
    }
    public function map($order): array
    {
        return [
            $order->id,
            $order->no_of_items,
            $order->ordering_date,
            $order->total_price_before_discount,
            $order->total_price_after_discount,
            $order->delivery,
            $order->receiving_address,
            $order->state,
            $order->customer->name,


        ];
    }
    public function headings(): array
    {
        return [
            'رقم الفاتورة',
            'عدد المنتجات',
            'تاريخ الفاتورة',
            "السعر قبل الخصم",
            "السعر بعد الخصم",
            "مصاريف توصيل",
            "العنوان",
            "الحالة",
            "العميل",

        ];
    }
    */
}
