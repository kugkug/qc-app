$(document).ready(function () {
    if ($("[data-key=IndustryId]").length) {
        $("[data-key=IndustryId]").off();
        $("[data-key=IndustryId]").on("change", function () {
            let value = $(this).val() ? $(this).val() : 0;

            ajaxRequest(
                "/executor/sub-industries-list/" + value,
                {
                    element_key: "SubIndustryId",
                },
                ""
            );
        });
    }

    if ($("[data-key=SubIndustryId]").length) {
        $("[data-key=SubIndustryId]").off();
        $("[data-key=SubIndustryId]").on("change", function () {
            let value = $(this).val() ? $(this).val() : 0;

            ajaxRequest(
                "/executor/business-lines-list/" + value,
                {
                    element_key: "BusinessLineId",
                },
                ""
            );
        });

        if ($("[data-key=BusinessLineText]").length) {
            $("[data-key=BusinessLineText]").attr("disabled", false);
        }
    }
});
