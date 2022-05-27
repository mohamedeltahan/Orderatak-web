export function ajaxFunction(object, url, method) {
    var $my_result=0;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if($.ajax({
        url: url,
        type: method,
        async:false,
        //request data
        data: object,
        success: function (result)  {
            $my_result=result;

            return result;
        },
        error: function (data) {
            alert('Error on updating, please try again later!');
            return false;
        }
    }))
        return $my_result;
    else
        return false;
}
