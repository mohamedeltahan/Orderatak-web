$(document).ready( function () {
    $('#example').DataTable({
       // "paging":   false,
      //  "ordering": false,
     //   "info":     false
    });
   // var table = $('#example').DataTable();

    //close transaction toggle
    $(".close-popup").click(function(){
        $(this).parent().fadeOut();
    });
    //notes popup
  /*  $("td").click(function(){
       $("#p").text( $(this).parent().attr("data-details"));
        $(".details-popup-container").fadeIn();
    });*/
    //add transaction toggle
    $(".add-transaction").click(function(){
        $(".transaction-form-container").toggleClass("slide");
    });
} );

