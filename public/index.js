let toto = true;

$(document).ready(function() {

    // $('#form-res-submit').click(function(e) {
    //     //e.preventDefault();
    //     console.log($('#form-res-date-field').val());
    //     let inputDateStr = $('#form-res-date-field').val();
    //     let inputDate = dayjs(inputDateStr);
    //     let now = dayjs();
    //     let now60j = now.add(60, 'day');
    //
    //     dayjs.extend(window.dayjs_plugin_isSameOrBefore);
    //     if (inputDate.isSameOrBefore(now60j)) {
    //         console.log("day js marche : date entrée inférieure à 2 mois");
    //     }
    //
    //
    // })

    $(function() {
        var selectedClass = "";
        $(".filter").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#gallery").fadeTo(100, 0.1);
            $("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
            setTimeout(function() {
                $("."+selectedClass).fadeIn().addClass('animation');
                $("#gallery").fadeTo(300, 1);
            }, 300);
        });
    });
})

