<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" href="{{asset("plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css")}}">
    <title>reciept</title>
    <style>
        .d{
            min-height: 1637px;
            max-height: 3262px;
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
<div class="d" style="padding: 25px; display: grid; font-size:24px;font-weight:bold">
    <div class="header" style="height: 15%">
        <div class="left" style="font-size: 26px; font-weight: bold; width: 25%; float: left; text-align: center;">
            <span>نوع الطلب / جديد</span>
            <p>  رقم الطلب :
                @foreach( $order->customer->phones as $phone)
                {{$phone->phone}}
            @endforeach
            </p>
        </div>
        <div class="right" style="font-size: 56px; font-weight: bold; width: 25%; text-transform: capitalize; float: right; text-align: right; text-align: center;">
            <span> fabrika </span>
        </div>
    </div>
    <div class="data" style="margin-top: 50px; padding: 50px 50px; height: 20%">
        <div class="client-data" style="float: right; text-align: right; width: 40%;">
            <span style=" font-size: 32px; font-weight: bold;">...تفـــاصيل العمــــيل</span>
            <ul style="text-align: right; list-style: none; font-size: 22px; width:100%;">
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
            <span style=" font-size: 32px; font-weight: bold;">...نوع الطلب</span>
            <p style=" font-size: 22px; font-weight: bold;">{{$order->type}}</p>
        </div>
        <div class="client-data" style="float: right; text-align: right; width: 20%;">
            <span style=" font-size: 32px; font-weight: bold;">...تفـــاصيل الطـــلب</span>
            <ul style="text-align: right; list-style: none; font-size: 22px;">
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
                    <th>لون</th>
                    <th>مقاس</th>
                    <th>كود</th>
                </tr>
                @foreach($order->items as $item )
                <tr style="border: solid 1px gray; height: 50px;">
                    <td>{{$item->total_price()}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price()}}</td>
                    <td>{{$item->name->color}}</td>
                    <td>{{$item->size}}</td>
                    <td>{{$item->name->code}}</td>
                </tr>
                    @endforeach
                @foreach($order->items as $item )
                    <tr style="border: solid 1px gray; height: 50px;">
                        <td>{{$item->total_price()}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->price()}}</td>
                        <td>{{$item->name->color}}</td>
                        <td>{{$item->size}}</td>
                        <td>{{$item->name->code}}</td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    <div class="roles" style="height: 30%; margin-top: 50px;" >
        <div class="rol">
            <ul style="text-align: right; list-style: none; width: 70%; float: right; font-weight: bold;">
                <li>مصاريف الشحن تدفع في كل الاحوال</li>
                <li>رجاء التواجد عند استلام الحذاء لتأكد من مقاس الحذاء وفي حالة اختلاف المقاس رجاء رد الحذاء مع المندوب</li>
                <li>في حالة استبدال المقاس تدفع مصاريف الشحن كاملة في اول زيارة / وعند الاستبدال تدفع نصف مصاريف الشحن في الزيارة اثانيه</li>
                <li>[F.B/Fabrika-shoes Tel:01550764524 <br> 01016481841 <br> 01141963005]</li>
                <li>إذا كان لديج اى سؤال او استفسار لا تتردد في الاتصال بنا</li>
                <li>Thank You</li>
            </ul>
        </div>
        <div class="details" style="width: 30%; text-align: center;">
            <table style="width: 100%; text-align: center; font-size: 16px; font-weight: bold;">
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
<div class="d" style="padding: 25px; display: grid; font-size:24px;font-weight:bold">
<div class="header">
    <div class="left" style="font-size: 26px; font-weight: bold; width: 25%; float: left; text-align: center;">
        <span>نوع الطلب / جديد</span>
        <p>  رقم الطلب :
            @foreach( $order->customer->phones as $phone)
                {{$phone->phone}}
            @endforeach
        </p>
    </div>
    <div class="right" style="font-size: 56px; font-weight: bold; width: 25%; text-transform: capitalize; float: right; text-align: right; text-align: center;">
        <span> fabrika </span>
    </div>
</div>
<div class="data" style="margin-top: 50px; padding: 50px 50px;">
    <div class="client-data" style="float: right; text-align: right; width: 40%;">
        <span style=" font-size: 32px; font-weight: bold;">...تفـــاصيل العمــــيل</span>
        <ul style="text-align: right; list-style: none; font-size: 22px; width:100%;">
            <li>الاسم / <span>{{$order->customer->name}}</span></li>
            <li>الكود / <span>{{$order->customer->id}}</span></li>
            <li>المحافظة / <span>{{$order->customer->governorate}}</span></li>
            <li>العنوان / <span>{{$order->receiving_address}}ة</span></li>
            <li>الموبايل / <span>  @foreach( $order->customer->phones as $phone)
                        {{$phone->phone}}
                    @endforeach</span></li>
        </ul>
    </div>
    <div class="client-data" style="float: right; text-align: center; width: 40%;">
        <span style=" font-size: 32px; font-weight: bold;">...نوع الطلب</span>
        <p style=" font-size: 22px; font-weight: bold;">{{$order->type}}</p>
    </div>
    <div class="client-data" style="float: right; text-align: right; width: 20%;">
        <span style=" font-size: 32px; font-weight: bold;">...تفـــاصيل الطـــلب</span>
        <ul style="text-align: right; list-style: none; font-size: 22px;">
            <li>الكود / <span> {{$order->id}} </span></li>
            <li>البوليصة / <span>{{$order->policy_id}}</span></li>
            <li>مدخل الطلب / <span>{{$order->user->name}}</span></li>
            <li>   / تاريخ الادخال   <br><span>{{$order->created_at}} <br> </span></li>
        </ul>
    </div>
</div>
<div class="items">
    <table style="width: 100%; text-align: center;">
        <tbody>
        <tr style="border: solid 1px gray; height: 50px;">
            <th>الاجمالى</th>
            <th>الكمية</th>
            <th>السعر</th>
            <th>لون</th>
            <th>مقاس</th>
            <th>كود</th>
        </tr>
        @foreach($order->items as $item )
            <tr style="border: solid 1px gray; height: 50px;">
                <td>{{$item->total_price()}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price()}}</td>
                <td>{{$item->name->color}}</td>
                <td>{{$item->size}}</td>
                <td>{{$item->name->code}}</td>
            </tr>
        @endforeach
        @foreach($order->items as $item )
            <tr style="border: solid 1px gray; height: 50px;">
                <td>{{$item->total_price()}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price()}}</td>
                <td>{{$item->name->color}}</td>
                <td>{{$item->size}}</td>
                <td>{{$item->name->code}}</td>
            </tr>
        @endforeach


        </tbody>
    </table>
</div>
<div class="roles" style="margin-top: 50px;">
    <div class="rol">
        <ul style="text-align: right; list-style: none; width: 70%; float: right; font-weight: bold;">
            <li>مصاريف الشحن تدفع في كل الاحوال</li>
            <li>رجاء التواجد عند استلام الحذاء لتأكد من مقاس الحذاء وفي حالة اختلاف المقاس رجاء رد الحذاء مع المندوب</li>
            <li>في حالة استبدال المقاس تدفع مصاريف الشحن كاملة في اول زيارة / وعند الاستبدال تدفع نصف مصاريف الشحن في الزيارة اثانيه</li>
            <li>[F.B/Fabrika-shoes Tel:01550764524 <br> 01016481841 <br> 01141963005]</li>
            <li>إذا كان لديج اى سؤال او استفسار لا تتردد في الاتصال بنا</li>
            <li>Thank You</li>
        </ul>
    </div>
    <div class="details" style="width: 30%; text-align: center;">
        <table style="width: 100%; text-align: center; font-size: 16px; font-weight: bold;">
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
<div class="d" style="padding: 25px; display: grid; font-size:24px;font-weight:bold">
    <div class="header">
        <div class="left" style="font-size: 26px; font-weight: bold; width: 25%; float: left; text-align: center;">
            <span>نوع الطلب / جديد</span>
            <p>  رقم الطلب :
                @foreach( $order->customer->phones as $phone)
                    {{$phone->phone}}
                @endforeach
            </p>
        </div>
        <div class="right" style="font-size: 56px; font-weight: bold; width: 25%; text-transform: capitalize; float: right; text-align: right; text-align: center;">
            <span> fabrika </span>
        </div>
    </div>
    <div class="data" style="margin-top: 50px; padding: 50px 50px;">
        <div class="client-data" style="float: right; text-align: right; width: 40%;">
            <span style=" font-size: 32px; font-weight: bold;">...تفـــاصيل العمــــيل</span>
            <ul style="text-align: right; list-style: none; font-size: 22px; width:100%;">
                <li>الاسم / <span>{{$order->customer->name}}</span></li>
                <li>الكود / <span>{{$order->customer->id}}</span></li>
                <li>المحافظة / <span>{{$order->customer->governorate}}</span></li>
                <li>العنوان / <span>{{$order->receiving_address}}ة</span></li>
                <li>الموبايل / <span>  @foreach( $order->customer->phones as $phone)
                            {{$phone->phone}}
                        @endforeach</span></li>
            </ul>
        </div>
        <div class="client-data" style="float: right; text-align: center; width: 40%;">
            <span style=" font-size: 32px; font-weight: bold;">...نوع الطلب</span>
            <p style=" font-size: 22px; font-weight: bold;">{{$order->type}}</p>
        </div>
        <div class="client-data" style="float: right; text-align: right; width: 20%;">
            <span style=" font-size: 32px; font-weight: bold;">...تفـــاصيل الطـــلب</span>
            <ul style="text-align: right; list-style: none; font-size: 22px;">
                <li>الكود / <span> {{$order->id}} </span></li>
                <li>البوليصة / <span>{{$order->policy_id}}</span></li>
                <li>مدخل الطلب / <span>{{$order->user->name}}</span></li>
                <li>   / تاريخ الادخال   <br><span>{{$order->created_at}} <br> </span></li>
            </ul>
        </div>
    </div>
    <div class="items">
        <table style="width: 100%; text-align: center;">
            <tbody>
            <tr style="border: solid 1px gray; height: 50px;">
                <th>الاجمالى</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>لون</th>
                <th>مقاس</th>
                <th>كود</th>
            </tr>
            @foreach($order->items as $item )
                <tr style="border: solid 1px gray; height: 50px;">
                    <td>{{$item->total_price()}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price()}}</td>
                    <td>{{$item->name->color}}</td>
                    <td>{{$item->size}}</td>
                    <td>{{$item->name->code}}</td>
                </tr>
            @endforeach
            @foreach($order->items as $item )
                <tr style="border: solid 1px gray; height: 50px;">
                    <td>{{$item->total_price()}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price()}}</td>
                    <td>{{$item->name->color}}</td>
                    <td>{{$item->size}}</td>
                    <td>{{$item->name->code}}</td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
    <div class="roles" style="margin-top: 50px;">
        <div class="rol">
            <ul style="text-align: right; list-style: none; width: 70%; float: right; font-weight: bold;">
                <li>مصاريف الشحن تدفع في كل الاحوال</li>
                <li>رجاء التواجد عند استلام الحذاء لتأكد من مقاس الحذاء وفي حالة اختلاف المقاس رجاء رد الحذاء مع المندوب</li>
                <li>في حالة استبدال المقاس تدفع مصاريف الشحن كاملة في اول زيارة / وعند الاستبدال تدفع نصف مصاريف الشحن في الزيارة اثانيه</li>
                <li>[F.B/Fabrika-shoes Tel:01550764524 <br> 01016481841 <br> 01141963005]</li>
                <li>إذا كان لديج اى سؤال او استفسار لا تتردد في الاتصال بنا</li>
                <li>Thank You</li>
            </ul>
        </div>
        <div class="details" style="width: 30%; text-align: center;">
            <table style="width: 100%; text-align: center; font-size: 16px; font-weight: bold;">
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
