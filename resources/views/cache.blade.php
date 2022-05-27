
<!DOCTYPE html>
<html lang="en">
@include("includes.exporter_head")
<style>
    .dataTables_filter{
        direction: rtl;
    }
</style>
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

        <form method="post" action="{{route("caches.store")}}">
            @csrf
            type <input name="type">
            details <input name="details">
            amount <input name="amount">
            paid_or_recieved <input name="paid_or_recieved">
            receipt_id<input name="receipt_id">
            date <input name="date">


            <input type="submit">

        </form>


        <script  src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{asset("js/navbar.js")}}"></script>
        <script type="module" src="{{asset("js/exporters.js")}}"></script>
</body>
</html>
