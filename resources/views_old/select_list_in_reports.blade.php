<style>
    .dataTables_filter{
        direction: rtl;
    }
</style>
<div class="inp-cont" style="margin-top: 20px">
    <select name="type" id="select" style="     width: 30%;
    text-align: right;
    padding: 10px;
    border: solid 1px lightseagreen;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -o-border-radius: 10px;
    -ms-border-radius: 10px;
    border-radius: 10px;
margin-left: 35%;
text-align: center;">
        <option disabled selected>اختر تقرير</option>

        <option  value="{{route("most_paying_customers")}}">العملاء الاكثر شراءا</option>
        <option value="{{route("less_paying_customers")}}">العملاء الاقل شراءا</option>

        <option value="{{route("waiting_customers")}}">عملاء قيد الانتظار</option>
        <option value="{{route("most_profit_items")}}">اكثر الاصناف ربحا</option>
        <option value="{{route("less_profit_items")}}">اقل الاصناف ربحا</option>
        <option value="{{route("most_sell_items")}}">اكثر الاصناف مبيعا</option>
        <option value="{{route("less_sell_items")}}">اقل الاصناف مبيعا</option>
        <option value="{{route("most_available_items")}}">اكثر الاصناف توافرا</option>
        <option value="{{route("less_available_items")}}">اقل الاصناف توافرا</option>

    </select>

</div>
