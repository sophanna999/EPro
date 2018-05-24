$(function(){


    $(".ask").click(function(e){
        e.preventDefault();
        $(this).next().toggleClass("open");
    });

    $(".telno-row .telno").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }


    })
    .keyup(function(e){
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }else{
            if( $(this).closest(".telno-wrapper").next().hasClass("dashed") ){
                $(this).closest(".telno-wrapper").next().next().find("input").focus();
                if( $(this).closest(".telno-wrapper").next().next().find("input").length > 0 )
                    $(this).closest(".telno-wrapper").next().next().find("input")[0].select();
            }else{
                $(this).closest(".telno-wrapper").next().find("input").focus();
                if( $(this).closest(".telno-wrapper").next().next().find("input").length > 0 )
                    $(this).closest(".telno-wrapper").next().find("input")[0].select();
            }
        }
        
    });

    $("#googleMap").on("shown.bs.modal", function(e){
        $("#googleMapBox").width("100%").height(400);
        if( $("#googleMapBox > div").length == 0 ){
            $('#googleMapBox').gmap3({
              center:[13.793645,100.57496], 
              zoom: 13,
              mapTypeId : google.maps.MapTypeId.ROADMAP
            })
            .marker({
                position:[13.793645,100.57496]
            });
        }
    });

    $(".rating-group").rating();
    

});