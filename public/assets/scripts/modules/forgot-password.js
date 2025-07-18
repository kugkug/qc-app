$(document).ready(function () {
    if ($("[data-trigger=forgot-password]").length) {
        $("[data-trigger=forgot-password]").off();
        $("[data-trigger=forgot-password]").on("click", function () {
            let parentForm = $(this).closest("form");

            if (!_checkFormFields(parentForm)) {
                _systemAlert("warning", "Please complete the required fields!");
                return;
            }

            let json_data_form = JSON.parse(_collectFields(parentForm));
            ajaxRequest("/executor/forgot-password", json_data_form, $(this));
        });
    }
});
