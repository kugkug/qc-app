$(document).ready(function () {
    if ($("[data-trigger=apply-health-certificate]").length) {
        $("[data-trigger=apply-health-certificate]").off();
        $("[data-trigger=apply-health-certificate]").on("click", function () {
            let parentForm = $(this).closest("form");

            if (!_checkFormFields(parentForm)) {
                _systemAlert("warning", "Please complete the required fields!");
                return;
            }

            let json_data_form = JSON.parse(_collectFields(parentForm));
            ajaxRequest(
                "/executor/applicant/application",
                json_data_form,
                $(this)
            );
        });
    }

    if ($("[data-trigger=process-application]").length) {
        $("[data-trigger=process-application]").off();
        $("[data-trigger=process-application]").on("click", function () {
            let parentForm = $(this).closest("form");

            if (!_checkFormFields(parentForm)) {
                _systemAlert("warning", "Please complete the required fields!");
                return;
            }

            let json_data_form = JSON.parse(_collectFields(parentForm));

            ajaxRequest(
                "/executor/applicant/application/" + $(this).attr("data-refno"),
                json_data_form,
                $(this)
            );
        });
    }

    if ($(".chk-req").length) {
        $(".chk-req").off();
        $(".chk-req").on("click", function () {
            let chkCheckedCnt = 0;
            let chkReq = $(".chk-req");

            for (const chk of chkReq) {
                if ($(chk).is(":checked")) chkCheckedCnt++;
            }

            if (chkCheckedCnt == chkReq.length)
                $("[data-trigger=upload-requirements]").attr("disabled", false);
            else $("[data-trigger=upload-requirements]").attr("disabled", true);
        });
    }

    if ($(".custom-file-input").length) {
        $(".custom-file-input").off();
        $(".custom-file-input").on("change", function (e) {
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
                return;
            }
            let parentDiv = $(this).closest("div.row");
            let previewBtn = $(parentDiv).find("button.btn-preview")[0];

            if (previewBtn) {
                $(previewBtn).attr("data-image", fullPath);
                $(previewBtn).attr("disabled", false);
            } else {
                $(previewBtn).attr("disabled", true);
            }

            $(this).next("label").html(fileName);
        });
    }

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

    if ($("[data-trigger=upload-requirements]").length) {
        $("[data-trigger=upload-requirements]").off();
        $("[data-trigger=upload-requirements]").on("click", function () {
            let require_update = $(".requiresupdate").length;

            let parentForm = $(this).closest("form");

            let json_data_form = new FormData();
            let image_files = $(".custom-file-input");

            for (let image_file of image_files) {
                let image = $(image_file).get(0).files[0];
                if (!image) continue;

                let data_key = $(image_file).attr("data-key");
                let arr_data_key = data_key.split("_");
                let date_acquired = $(
                    "[data-key=DateUploaded_" + arr_data_key[1] + "]"
                ).val();

                json_data_form.append("Requirements[]", arr_data_key[1]);
                json_data_form.append("Images[]", image);
                json_data_form.append("AcquiredDates[]", date_acquired);
            }
            json_data_form.append(
                "IsUpdateRequired",
                require_update > 0 ? 1 : 0
            );

            ajaxSubmit(
                "/executor/applicant/upload-requirements/" +
                    $(this).attr("data-refno"),
                json_data_form,
                $(this)
            );
        });
    }
});
