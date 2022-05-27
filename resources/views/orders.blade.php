
<!DOCTYPE html>
<html lang="en">
@include("includes.exporter_head")
<body>
<input style="display: none" value="{{route("unpaid_transactions","")}}" id="unpaid_transactions">
<div class="layout-container-fluid">
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--start side menu component-->
@include("sidebars.sidebar")
<!--End side menu component-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--start body container-->
    <div class="body-content-container">
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--start navbar component-->
        @include("sidebars.navbar")

        <form method="post" action="{{route("orders.store")}}">
            @csrf
            before  <input name="total_price_before_discount">
            after <input name="total_price_after_discount">
            disount<input name="discount">
            no_of<input name="no_of_items">
            recev_date<input name="receiving_dates">
            ordering_dates<input name="ordering_dates">



            items_id<input  name="items_id[]">
            items_quantity   <input name="items_quantity[]">
            items_size  <input name="items_size[]">


            <input type="submit">

        </form>


        <script  src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{asset("js/navbar.js")}}"></script>
        <script type="module" src="{{asset("js/exporters.js")}}"></script>
</body>
</html>
