<!DOCTYPE html>
<html>
<head>
    <style>
        table, th, td {
            border: 3px solid black;
        }
    </style>
</head>
<body>

<table >
    <tr>
        <th>كمية</th>
        <th>مقاس</th>
        <th>كود</th>
        <th>صنف</th>
        <th>عنوان</th>
        <th>رقم العميل</th>
        <th>اسم العميل</th>
        <th>ملاحظة</th>

        <th>توصيل</th>
        <th>اجمالي القطع</th>
        <th>الاجمالي</th>
        <th>رقم البوليصة</th>
        <th>رقم الفاتورة</th>

    </tr>
  @foreach($orders as $order)
    <tr>


        <td>
            @for($i=0;$i<sizeof($order->items); $i++)
                {{$order->items[$i]->quantity}}
                @if($i!==sizeof($order->items)-1)<br>
            @endif

            @endfor
        </td>
        <td> @for($i=0;$i<sizeof($order->items); $i++)
                {{$order->items[$i]->size}}
                @if($i!==sizeof($order->items)-1)<br>
                @endif
                 @endfor
        </td>
        <td>
            @for($i=0;$i<sizeof($order->items); $i++)
                {{$order->items[$i]->name->code}}
                @if($i!==sizeof($order->items)-1)<br>
                @endif

            @endfor
        </td>
        <td>
            @for($i=0;$i<sizeof($order->items); $i++)
                {{$order->items[$i]->name->name}}
                @if($i!==sizeof($order->items)-1)<br>
                @endif
            @endfor
        </td>

        <td>{{$order->receiving_address}}</td>

        <td>@for($i=0;$i<sizeof($order->customer->phones); $i++)
                {{$order->customer->phones[$i]->phone}}
                @if($i!==sizeof($order->customer->phones)-1)-
                @endif
            @endfor</td>

        <td>{{$order->customer->name}}</td>
        <td>{{$order->details}}</td>

        <td>{{$order->delivery}}</td>
        <td>{{$order->no_of_items}}</td>
        <td>{{$order->total_price_after_discount}}</td>

        <td>{{$order->policy_id}}</td>

        <td>{{$order->id}}</td>

        @endforeach
    </tr>


<tr>
    <td> اجمالي قطع : {{$all_orders_quantity}} قطعة </td>

    <td></td>
    <td></td>

    <td> </td>
    <td> </td>
    <td> </td>
    <td> اجمالي شحن : {{$orders->sum("delivery")}}  جنيه </td>
    <td> اجمالي اوردرات : {{$orders->sum("total_price_after_discount")}}  جنيه </td>
    <td> </td>
    <td> اجمالي اوردرات : {{sizeof($orders)}} </td>



</tr>
        <tr>
            <td> اجمالي : {{$orders->sum("total_price_after_discount")}} جنيه  </td>
        </tr>
</table>

</body>
</html>
