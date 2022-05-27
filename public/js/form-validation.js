
    var $bool=true;
    function null_input(input) {
        $("."+input).each(function () {

            if($(this).val().length===0){
                $bool=false;
                $(this).css("background-color","#fce4e4");
                $(this).attr("placeholder","برجاء ادخال بيانات صحيحة");
                $(this).val("");


            }
        })

    }
    function wrong_length_input(input) {
        $("."+input).each(function () {
            var $length=$(this).attr("data-length");
            if($(this).val().length<$length){
                $bool=false;
                $(this).css("background-color","#fce4e4");
                $(this).attr("placeholder","برجاء ادخال بيانات صحيحة");
                $(this).val("");


            }
        })
    }
    function arabic_input() {

    }

   export function validate(input_array,input_condition_array) {

       $bool=true;
        for(var i=0;i<input_array.length;i++){
            for(var j=0;j<input_condition_array[i].length;j++){

                if (input_condition_array[i][j]==="null_input"){null_input(input_array[i])}
                if (input_condition_array[i][j]==="wrong_length_input"){wrong_length_input(input_array[i])}
                if (input_condition_array[i][j]==="arabic_input"){arabic_input(input_array[i])}


            }



        }
    return $bool;


    }

   // validate(["phone","name"],[["null_input","wrong_length_input"],["null_input"]])


