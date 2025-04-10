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

    // if (file.length) {
    //     $(file).off();
    //     $(file).click();
    //     $(file).on("change", function (e) {
    //         var nSize = $(this).get(0).files[0].size;
    //         var sFileName = $(this).get(0).files[0].name;
    //         var sFullPath = URL.createObjectURL(e.target.files[0]);

    //         var aFileName = sFileName.split(".");
    //         var sFileType = aFileName[aFileName.length - 1].toLowerCase();

    //         var fSExt = new Array("Bytes", "KB", "MB", "GB"),
    //             h = 0;
    //         while (nSize > 900) {
    //             nSize /= 1024;
    //             h++;
    //         }

    //         var vFileName = "";
    //         var sInvalid = "";
    //         var sTooLarge = "";
    //         var sWrongCamp = "";

    //         var nExactSize = Math.ceil(Math.ceil(nSize * 100) / 100);
    //         var vSizeCat = fSExt[h];
    //         var sSize = nExactSize + "" + vSizeCat;

    //         if (
    //             sFileType != "png" &&
    //             sFileType != "jpg" &&
    //             sFileType != "jpeg"
    //         ) {
    //             sInvalid += sFileName + " - " + sFileType + ".<br />";
    //         } else {
    //             if (h < 3) {
    //                 if (h == 2 && nExactSize > 25) {
    //                     sTooLarge += sFileName + " - " + sSize + ".<br />";
    //                 } else {
    //                     vFileName += sFileName + "\n\n";
    //                 }
    //             } else {
    //                 sTooLarge += sFileName + " - " + sSize + ".<br />";
    //             }
    //         }

    //         var sMessage = "";

    //         if (sInvalid != "") {
    //             sMessage +=
    //                 "<b>File/s Invalid Format:</b> <br />" +
    //                 sInvalid +
    //                 "<br /><br />";
    //         }

    //         if (sTooLarge != "") {
    //             sMessage +=
    //                 "<b>File/s Too Large:</b> <br />" +
    //                 sTooLarge +
    //                 "<br /><br />";
    //         }

    //         sMessage +=
    //             "Please be advised, this system can only accept PNG, JPG and JPEG formatted file with up to 25MB max size.";

    //         if (sTooLarge != "" || sInvalid != "" || sWrongCamp != "") {
    //             $(this).val("");
    //             _systemAlert("alert", sMessage);
    //         } else {
    //             $(".image-upload").attr("src", sFullPath);
    //         }
    //     });
    // }
});
