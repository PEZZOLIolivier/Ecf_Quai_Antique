
function ajaxGetReservationSlots() {
    let d = $("#form-res-date-field").val().slice(0, -3)+":00"
    console.log(d);
    $.ajax({
        url: "/a/reservation_slots",
        method: "POST",
        data: JSON.stringify({currentDate: d}),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
    })
    .done(function(data) {
        $("#slots").text(data['slots']);
        console.log("data : ", data);
    });
}

if (window.location.href.indexOf("/reservations") > -1) {
    ajaxGetReservationSlots();


    $("#form-res-date-field").change(function() {
        ajaxGetReservationSlots();
    })


}

let toastLiveExample = document.getElementById('liveToast')

if (toastLiveExample) {
    toastLiveExample.classList.add('show');
}








