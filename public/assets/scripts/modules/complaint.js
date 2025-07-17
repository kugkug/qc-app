$(document).ready(function () {
    $('[data-trigger="submit-complaint"]').click(function () {
        let parentForm = $(this).closest("form");

        if (!_checkFormFields(parentForm)) {
            _systemAlert("warning", "Please complete the required fields!");
            return;
        }

        let complaint_photo = $(".complaint-photo").get(0).files[0];
        console.log(complaint_photo);

        let form_data = new FormData();
        let fields = JSON.parse(_collectFields(parentForm));
        form_data.append("ComplaintPhoto", complaint_photo);

        $.each(fields, function (key, value) {
            form_data.append(key, value);
        });

        console.log(form_data);

        ajaxSubmit("/executor/complaint/submit", form_data, $(this));
    });
});
