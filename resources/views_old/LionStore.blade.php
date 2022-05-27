<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css")}}">
    <title>reciept</title>
    <style>
        .d{
            min-height: 800px;
            max-height: 1200px;
        }
        table td , th{
            border: solid 1px gray;
        }
        .client-data{
            text-align: center;
        }
        .details table td{
            padding: 10px ;
        }
    </style>
</head>
<body>
<div class="d" style="font-size: 34px; padding: 25px; display: grid;font-weight:bold">
    <div class="header" style="height: 15%">
        <div class="left" style="font-weight: bold; width: 25%; float: left; text-align: center;">
            <span>نوع الطلب / جديد</span>
            <p>  رقم الطلب :
                @foreach( $order->customer->phones as $phone)
                {{$phone->phone}}
            @endforeach
            </p>
        </div>
        <div class="right" style="font-weight: bold; width: 25%; text-transform: capitalize; float: right; text-align: right; text-align: center;">
            <span> <img style="max-height: 200px" src="{{asset("images"."/".\Illuminate\Support\Facades\Auth::user()->receipt_name)}}.jpeg"></span>

        </div>
    </div>
    <div class="data" style="margin-top: 50px; padding: 50px 50px; height: 20%">
        <div class="client-data" style="float: right; text-align: right; width: 40%;">
            <span style="font-weight: bold;">...تفـــاصيل العمــــيل</span>
            <ul style="text-align: right; list-style: none;width:100%;">
                <li>الاسم / <span>{{$order->customer->name}}</span></li>
                <li>الكود / <span>{{$order->customer->id}}</span></li>
                <li>المحافظة / <span>{{$order->customer->governorate}}</span></li>
                <li>العنوان / <span>{{$order->receiving_address}}</span></li>
                <li>ملاحظة / <span>{{$order->details}}</span></li>
                <li>الموبايل / <span>  @foreach( $order->customer->phones as $phone)
                                   {{$phone->phone}}
                                 @endforeach</span></li>
            </ul>
        </div>
        <div class="client-data" style="float: right; text-align: center; width: 40%;">
            <span style="font-weight: bold;">...نوع الطلب</span>
            <p style="font-weight: bold;">{{$order->type}}</p>
        </div>
        <div class="client-data" style="float: right; text-align: right; width: 20%;">
            <span style="font-weight: bold;">...تفـــاصيل الطـــلب</span>
            <ul style="text-align: right; list-style: none;">
                <li>الكود / <span> {{$order->id}} </span></li>
                <li>البوليصة / <span>{{$order->policy_id}}</span></li>
                <li>مدخل الطلب / <span>{{$order->user->name}}</span></li>
                <li>   / تاريخ الادخال   <br><span>{{$order->created_at}} <br> </span></li>
            </ul>
        </div>
    </div>
    <div class="items" style="height: 30%;">
        <table style="width: 100%; text-align: center;">
            <tbody>
                <tr style="border: solid 1px gray; height: 50px;">
                    <th>الاجمالى</th>
                    <th>الكمية</th>
                    <th>السعر</th>
                    <th>الصنف</th>
                </tr>
                @foreach($order->items as $item )
                <tr style="border: solid 1px gray; height: 50px;">
                    <td>{{$item->total_price()}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price()}}</td>
                    <td>{{$item->name->name}}</td>
                </tr>
                    @endforeach
               


            </tbody>
        </table>
    </div>
    <div class="roles" style="height: 30%; margin-top: 50px;" >
        <div class="rol">
            <ul style="text-align: right; list-style: none; width: 70%; float: right; font-weight: bold;">
                <li> ليون ستوور </li>
               <li>  العالم بين ايديك</li>
                <li>Lion Store <br> 01022212204</li>

                <li>Thank You</li>
            </ul>
        </div>
        <div class="details" style="width: 30%; text-align: center;">
            <table style="width: 100%; text-align: center;font-weight: bold;">
                <tbody>
                    <tr>
                        <td>{{$order->total_price_after_discount-$order->delivery}}</td>
                        <td>اجمالي القطع</td>
                    </tr>
                    <tr>
                        <td>{{$order->delivery}}</td>
                        <td>مصاريف الشحن</td>
                    </tr>
                    <tr>
                        <td>
                            @if($order->prev_total>$order->total_price_after_discount)
                                +{{$order->prev_total-$order->total_price_after_discount}}

                                @elseif($order->prev_total<$order->total_price_after_discount && $order->prev_total!=0)
                                  -{{$order->total_price_after_discount-$order->prev_total}}

                               @else
                                    0

                                @endif
                        </td>
                        <td>مصاريف إضافيه</td>
                    </tr>
                    <tr>
                        <td>{{$order->discount}}</td>
                        <td>خصم خاص</td>
                    </tr>
                    <tr>
                        <td>{{$order->total_price_after_discount}}</td>
                        <td>المجموع</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>

</html>
