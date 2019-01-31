$(document).ready(function() {

    $('a').click(openWindow);

    function openWindow(e) {
        let url = e.currentTarget.dataset.id;
        let response = '';

        $.when( jQuery.ajax({
           type: "GET",
           url: "includes/functions.php",

           data: {action: 'callMercuryAPI', url: url},
           success: function(result) {
             response = result;
           },
            error: function(err) {
               response = err;
            }
        })
        ).then(function() {
            response = JSON.parse(response);
            $('#title').html(response.title);
            $('#modal-content').html(response.content);
            $('#modal').css("display", "block");
        });
    }

    $('#close').click(function() {
        $('#modal').css("display", "none")
    });
    $(window).click(function(e) {
        if (e.target.id === "modal"){
            $('#modal').css("display", "none");
        }
    });
});