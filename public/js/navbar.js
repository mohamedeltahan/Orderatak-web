$(function() {
    $(".user-img").click(function(){
        $(".user-nav-list").addClass("slide");
    });
    // remove class from Li when click out side it
    var $nav_list = $(".user-nav-list");
    $(document).mouseup(function(e) {
        if (!$nav_list.is(e.target) // if the target of the click isn't the container...
            &&
            $nav_list.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $nav_list.removeClass('slide');
        }
    });
});

//==============================================================================================
$(".user-nav-list ul li").click(function(){

    $id= $(this).attr("id").split("_")[1];
    $(".li_"+$id)[0].click();
})

$(function() {
    $(".notification").click(function(){
        $(".user-notification-list").addClass("slide");
    });
    // remove class from Li when click out side it
    var $nav_list = $(".user-notification-list");
    $(document).mouseup(function(e) {
        if (!$nav_list.is(e.target) // if the target of the click isn't the container...
            &&
            $nav_list.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $nav_list.removeClass('slide');
        }
    });
});
$(function(){

    $(".toggle-menu").click(function(){
        $(".body-content-container").toggleClass("body-toggle");
        $(".menu-side-container").toggleClass("menu-side-toggle");

    });

});
