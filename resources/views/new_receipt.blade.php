<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Invoice - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="col-md-12">   
 <div class="row">
		
        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
    			<div class="receipt-header" style="margin-top:-18px">
					<div  style="float: left; width:50%">
						<div class="receipt-left">
							<img class="img-responsive" style="height:100px" alt="iamgurdeeposahan" src="{{asset("receipts-photos")."/".Auth::user()->photo_link}}">
						</div>
					</div>
					<div class="text-right" style="float: right; width:50%">
						<div class="receipt-right">
							<h5>{{Auth::user()->receipt_name}}</h5>
							<p>{{Auth::user()->receipt_phone}}<i class="fa fa-phone"></i></p>
						</div>
					</div>
				</div>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid">
                    <div class="" style="float: left; width:50%;">
						<div class="receipt-left">
                            <h3>     <span>رقم الفاتورة </span>  # {{$order->id}} </h3> 
                                    
						</div>
                        <div class="receipt-left">
                            <h3>     <span>رقم البوليصة </span>  # {{$order->policy_id}} </h3> 
                                    
						</div>
					</div>
					<div class="" style="text-align: right; float: right; width:50%; direction:rtl">
						<div class="receipt-right">
							<h5 style="font-size: 21px">{{$order->customer->name}}</h5>
							<p style="font-size: 21px"><b>رقم العميل :</b> @foreach( $order->customer->phones as $phone)
                                {{$phone->phone}}
                            @endforeach
                        </p>
							<p style="font-size: 21px"><b>محافظة العميل :</b> {{$order->customer->governorate}}</p>
							<p style="font-size: 21px"><b>عنوان العميل :</b> {{$order->receiving_address}}</p>
                            <p style="font-size: 21px"><b>تاريخ الطلب :</b> {{$order->ordering_date}}</p>

						</div>
					</div>
		
				</div>
            </div>
			
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th style="background-color: black">سعر</th>
                            <th style="background-color: black">كمية</th>
                            <th style="background-color: black">مقاس</th>
                            <th style="background-color: black">لون</th>
                            <th style="background-color: black">صنف</th>
                            <th style="background-color: black">كود</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item )
                        <tr>
                            <td class="col-md-3">{{$item->price()}}</td>
                            <td class="col-md-3">{{$item->quantity}}</td>
                            <td class="col-md-3">{{$item->size}}</td>
                            <td class="col-md-3">{{$item->name->color}}</td>

                            <td class="col-md-3">{{$item->name->name}}</td>

                            <td class="col-md-3">{{$item->name->code}}</td>

                        </tr>
                        @endforeach

                        <tr>
                            
                            <td>
                                <p>
                                    <strong><i class="fa fa-inr"></i> {{$order->total_price_after_discount-$order->delivery}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i> {{$order->delivery}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i> {{$order->discount}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i> {{$order->no_of_items()}}</strong>
                                </p>
                                </td>
                            <td class="text-right">
                            <p>
                                <strong>: اجمالي </strong>
                            </p>
                            <p>
                                <strong>: مصاريف الشحن  </strong>
                            </p>
							<p>
                                <strong>: خصم </strong>
                            </p>
							<p>
                                <strong>: عدد القطع </strong>
                            </p>
							</td>
                            
                        </tr>
                        <tr>
                           
                            <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> {{$order->total_price_after_discount}}</strong></h2></td>
                            <td class="text-right"><h2><strong>: اجمالي</strong></h2></td>

                        </tr>
                    </tbody>
                </table>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid receipt-footer">
                   
					<div class="col-12" style="text-align: right">
						<div class="receipt-right">
							<h5 style="color: rgb(140, 140, 140);">{{Auth::user()->receipt_message}}</h5>
						</div>
					</div>
					
				</div>
            </div>
			
        </div>    
	</div>
</div>

<style type="text/css">
body{
background:#eee;
margin-top:20px;
}
.text-danger strong {
        	color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #9f181c;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		#container {
			background-color: #dcdcdc;
		}
</style>

<script type="text/javascript">

</script>
</body>
</html>