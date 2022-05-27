<?php

namespace App\Exports;

use App\Export;
use Cassandra\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportsExport implements FromQuery, WithMapping,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
     use Exportable;


    function __construct($start,$end)
    {
        $this->start=$start;
        $this->end=$end;
    }

    public function query()
     {  $from = date($this->start);
         $to = date($this->end);
         return Export::query()->whereDate("created_at", ">=",$from)->whereDate("created_at","<=",$to);
     }
    public function map($export): array
    {
        return [
            $export->id,
            $export->no_of_items,
            $export->receiving_dates,
            $export->total_price_before_discount,
            $export->total_price_after_discount,
            $export->exporter->name,


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
            "المورد",

        ];
    }
}
