$(document).ready(function () {
    if ($("[data-trigger=reset-password]").length) {
        $("[data-trigger=reset-password]").off();
        $("[data-trigger=reset-password]").on("click", function () {
            let parentForm = $(this).closest("form");

            if (!_checkFormFields(parentForm)) {
                _systemAlert("warning", "Please complete the required fields!");
                return;
            }

            // Check if passwords match
            let password = parentForm.find('[data-key="password"]').val();
            let passwordConfirmation = parentForm
                .find('[data-key="password_confirmation"]')
                .val();

            if (password !== passwordConfirmation) {
                _systemAlert("warning", "Passwords do not match!");
                return;
            }

            let json_data_form = JSON.parse(_collectFields(parentForm));
            json_data_form = {
                ...json_data_form,
                token: parentForm.find('[data-key="token"]').val(),
            };
            ajaxRequest("/executor/reset-password", json_data_form, $(this));
        });
    }
});
