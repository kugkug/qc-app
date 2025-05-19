$(document).ready(function () {
    if ($(".btn-preview").length) {
        $(".btn-preview").off();
        $(".btn-preview").on("click", function (e) {
            $("#modal-preview .modal-body").html(
                "<img src='" +
                    $(this).attr("data-image") +
                    "' class='image-responsive' style='width: 400px;'/>"
            );
            $("#modal-preview").modal("show");
        });
    }

    if ($(".btn-preview-hid").length) {
        $(".btn-preview-hid").off();
        $(".btn-preview-hid").on("click", function (e) {
            // $("#modal-health-card .modal-body").html(

            // );
            $("#modal-health-card").modal("show");
        });
    }
});
