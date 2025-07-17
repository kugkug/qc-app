let interval = null;
$(document).ready(function () {
    $("[data-trigger='verify-otp-submit']").click(function (e) {
        e.preventDefault();
        var otp = $("[data-key='Otp']").val();
        if (!otp) {
            _confirm("alert", "Please enter OTP!");
            return;
        }

        ajaxRequest("/executor/validate-otp", {
            token: $("#token").val(),
            otp: otp,
        });

        // $.ajax({
        //     url: "/executor/validate-otp",
        //     type: "GET",
        //     dataType: "json",
        //     headers: {
        //         "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
        //     },
        //     data: {
        //         token: $("#token").val(),
        //         otp: otp,
        //     },
        //     success: function (response) {
        //         console.log(response);
        //         if (response.status) {
        //             eval(response.js);
        //         } else {
        //             _confirm("alert", response.message);
        //         }
        //     },
        //     error: function (xhr, status, error) {
        //         _confirm(
        //             "alert",
        //             "Cannot continue, please call system administrator!"
        //         );
        //         console.log(xhr.responseText);
        //     },
        // });
    });

    interval = setInterval(_expirationCountdown, 1000);
});

function _expirationCountdown() {
    $.ajax({
        url: "/executor/countdown",
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $("meta[name='_token']").attr("content"),
        },
        data: {
            token: $("#token").val(),
        },
        success: function (response) {
            $("#expiry-countdown").html(response.message);
            if (!response.status) {
                clearInterval(interval);
            }

            $("#resend-otp").click(function () {
                let id = $(this).attr("data-id");
                ajaxRequest("/executor/resend-otp", { id: id });
                // $.ajax({
                //     url: "/executor/resend-otp",
                //     type: "GET",
                //     dataType: "json",
                //     headers: {
                //         "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr(
                //             "content"
                //         ),
                //     },
                //     data: { id: id },
                //     success: function (response) {
                //         console.log(response);
                //         _confirm("info", response.message);
                //         eval(response.js);
                //     },
                //     error: function (xhr, status, error) {
                //         console.log(xhr.responseText);
                //         _confirm(
                //             "alert",
                //             "Cannot continue, please call system administrator!"
                //         );
                //     },
                // });
            });
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
    });
}
