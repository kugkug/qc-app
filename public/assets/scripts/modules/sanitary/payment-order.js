$(document).ready(function () {
    let file = $("[type=file]");

    if ($("[type=file]")) {
        $("[type=file]").off();
        $("[type=file]").on("change", function (e) {
            let fileSize = $(this).get(0).files[0].size;
            let fileName = $(this).get(0).files[0].name;
            let fullPath = URL.createObjectURL(e.target.files[0]);
            let fileNames = fileName.split(".");
            let fileType = fileNames[fileNames.length - 1].toLowerCase();

            var fSExt = new Array("Bytes", "KB", "MB", "GB"),
                h = 0;
            while (fileSize > 900) {
                fileSize /= 1024;
                h++;
            }

            if (fileType != "png" && fileType != "jpg" && fileType != "jpeg") {
                _systemAlert(
                    "warning",
                    "Please be advised, this system can only accept PNG, JPG and JPEG formatted file with up to 25MB max size."
                );

                $("#div-uploads").html(``);
                $(".div-main-uploads").removeClass("d-none").addClass("d-none");
                $(".file-drop-area").removeClass("d-none");

                $(".btn-reset").attr("disabled", true);
                $(".btn-save").attr("disabled", true);

                return;
            }

            $("#div-uploads").html(
                `<img src="${fullPath}" class="img-fluid"/>`
            );
            $(".div-main-uploads").removeClass("d-none");
            $(".file-drop-area").removeClass("d-none").addClass("d-none");

            $(".btn-reset").attr("disabled", false);
            $(".btn-save").attr("disabled", false);
        });
    }

    if ($(".btn-upload").length) {
        $(".btn-upload").off();
        $(".btn-upload").on("click", function (e) {
            $("#modal-upload").modal("show");
        });
    }

    $(".btn-reset").off();
    $(".btn-reset").on("click", function () {
        $("#div-uploads").html("");
        $(".file-drop-area").removeClass("d-none");
        $(".div-main-uploads").addClass("d-none");

        $(".choose-file-button").text("Choose files");
        $(".file-message").text("or drag and drop files here");
    });

    $(".btn-save").off();
    $(".btn-save").on("click", function (e) {
        e.preventDefault();

        let receipt_file = $(".file-input").get(0).files[0];

        if (receipt_file) {
            let form_data = new FormData();
            form_data.append("RecieptPhoto", receipt_file);
            ajaxSubmit(
                "/executor/applicant/update-payment-order/" +
                    $(this).attr("data-ref-no"),
                form_data,
                $(this)
            );
        }
        // if (fileLength > 0) {

        //     for (let x = 0; x < fileLength; x++) {
        //         form_data.append("labels[]", $("#label_" + x).val());
        //         form_data.append("files[]", files[x]);
        //     }

        // } else {
        //     _systemAlert("error", "No files have been selected!");
        // }
    });
});
