jQuery(function($) {

    $(".wcs-bt-open").click(function(){
       $(this).siblings(".wcs-content").fadeToggle("fast");
    });
    $(".wcs-bt-close").click(function(){
        $(this).parent().parent().fadeOut("fast");
    });
   $(".wcs-content").click(function(){
        $(this).fadeOut("fast");
    });
});
