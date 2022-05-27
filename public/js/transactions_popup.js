$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
if ($.ajax({
    async: false,
    url: $("#get_unpaid_transactions").val() + "/" + $(this).find('option:selected').val(),
    dataType: "json",
    method: "get",
    //request data
    success: function (result) {
        perm = result;

    },
    error: function (data) {
        alert('Error on updating, please try again later!');
        return false;
    }
})){}
