$(document).ready(function () {
    const prevBtns = $(".btn-prev");
    const nextBtns = $(".btn-next");
    const progress = $("#progress");
    const formSteps = $(".step-forms");
    const progressSteps = $(".progress-step");

    let formStepsNum = 0;

    nextBtns.each(function () {
        $(this).click(function (e) {
            e.preventDefault();
            if (formStepsNum === 0) {
                submitFirstStep();
            } else if (formStepsNum === 1) {
                submitSecondStep();
            } else {
                // Move to the next step without validation
                formStepsNum++;
                updateFormSteps();
                updateProgressbar();
            }
        });
    });

    prevBtns.each(function () {
        $(this).click(function (e) {
            e.preventDefault();
            formStepsNum--;
            updateFormSteps();
            updateProgressbar();
        });
    });
    // $("#room_price").click(function () {
    //     loadFee();
    // });


    function submitFirstStep() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData();
        formData.append('rooms_count', $('#rooms_count').val());
        formData.append('room_name', $('#room_name').val());
        formData.append('room_status', $('#room_status').val());
        formData.append('view_side', $('#view_side').val());
        formData.append('description', $('#description').val());
        formData.append('property_id', $('#property_id').val());
        formData.append('room_type_id', $('#room_type_id').val());

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: '/store-room',
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response); // Log the full response

                if (response.status === 'success') { // Assuming response.success contains the success message
                    toastr.success(response.message, 'Success', {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    });

                    formStepsNum++;
                    updateFormSteps();
                    updateProgressbar();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR); // Log the error details
                toastr.error(jqXHR.responseJSON.error, 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
    }

    function submitSecondStep() {
        // Ensure all fields are filled before proceeding
        var requiredFields = ['rooms_count', 'room_type_id', 'property_id', 'bedrooms', 'max_persons', 'availablity_status', 'bathrooms', 'room_size'];
        var allFieldsFilled = true;

        requiredFields.forEach(function (field) {
            if (!$('#' + field).val()) {
                toastr.error('Please fill out all required fields.', 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                });
                allFieldsFilled = false;
            }
        });

        if (!allFieldsFilled) {
            return; // Stop form submission if any field is empty
        }

        var formData = new FormData();
        formData.append('rooms_count', $('#rooms_count').val());
        formData.append('room_type_id', $('#room_type_id').val());
        formData.append('property_id', $('#property_id').val());
        formData.append('bedrooms', $('#bedrooms').val());
        formData.append('max_persons', $('#max_persons').val());
        formData.append('availablity_status', $('#availablity_status').val());
        formData.append('bathrooms', $('#bathrooms').val());
        formData.append('room_size', $('#room_size').val());

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: '/store-room-info', // Replace with your actual endpoint URL
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response); // Handle the response here
                if (response.status === 'success') {
                    toastr.success(response.message, 'Success', {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    });
                    formStepsNum++;
                    updateFormSteps();
                    updateProgressbar();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus); // Log any errors
                toastr.error(jqXHR.responseJSON.error, 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
    }

    function updateFormSteps() {
        formSteps.removeClass("step-forms-active");
        formSteps.eq(formStepsNum).addClass("step-forms-active");
    }

    function updateProgressbar() {
        progressSteps.each(function (idx) {
            if (idx < formStepsNum + 1) {
                $(this).addClass("progress-step-active");
            } else {
                $(this).removeClass("progress-step-active");
            }
        });

        progressSteps.each(function (idx) {
            if (idx < formStepsNum) {
                $(this).addClass("progress-step-check");
            } else {
                $(this).removeClass("progress-step-check");
            }
        });

        const progressActive = $(".progress-step-active");
        progress.width(((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%");
    }

    $("#submit-form").click(function (e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append('rooms_count', $('#rooms_count').val());
        formData.append('room_name', $('#room_name').val());
        formData.append('room_status', $('#room_status').val());
        formData.append('view_side', $('#view_side').val());
        formData.append('description', $('#description').val());
        formData.append('property_id', $('#property_id').val());
        formData.append('room_type_id', $('#room_type_id').val());
        formData.append('bedrooms', $('#bedrooms').val());
        formData.append('bathrooms', $('#bathrooms').val());
        formData.append('room_size', $('#room_size').val());
        formData.append('max_persons', $('#max_persons').val());
        formData.append('availablity_status', $('#availablity_status').val());
        formData.append('room_price', $('#room_price').val());
        formData.append('currency', $('input[name="currency"]:checked').val());
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: '/submit-room-form', 
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response); 
                if (response.status === 'success') {
                    progressSteps.each(function (idx) {
                        if (idx <= formStepsNum) {
                            $(this).addClass("progress-step-check");
                        } else {
                            $(this).removeClass("progress-step-check");
                        }
                    });

                    var forms = $("#forms");
                    forms.removeClass("form");
                    forms.html('<div class="welcome"><div class="content"><svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg><h3>Room Created Successfully!</h3><span>Go Back to see !</span><div></div>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus,jqXHR ,errorThrown); 
                toastr.error(jqXHR.responseJSON.error, 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                });
            }
        });
    });



    $('input[name="currency"]').change(function () {
        if ($('input[name="currency"]:checked').length > 0) {
            $('#feeDiv').show();
        } else {
            $('#feeDiv').hide();
        }
    });



    // $("#submit-form").click(function () {
    //     progressSteps.each(function (idx) {
    //         if (idx <= formStepsNum) {
    //             $(this).addClass("progress-step-check");
    //         } else {
    //             $(this).removeClass("progress-step-check");
    //         }
    //     });

    //     var forms = $("#forms");
    //     forms.removeClass("form");
    //     forms.html('<div class="welcome"><div class="content"><svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg><h2>Thanks for signing up!</h2><span>We will contact you soon!</span><div></div>');
    // });
});



function loadFee() {
    var amount = $('#room_price').val().trim();

    if (amount === '') {
        $('#contract-container').html('');
        $('#submit-form').prop('disabled', true);
        return;
    }

    $.ajax({
        url: '/get-fee',
        type: 'GET',
        data: {
            roomType: $('#room_type_id').val(),
            currency: $('input[name="currency"]:checked').val(),
            amount: amount
        },
        success: function (response) {
            console.log(response);
            $('#contract-container').html(response.contract);
            $('#submit-form').prop('disabled', false); // Enable the Save button

            // console.log(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
            toastr.error(jqXHR.responseJSON.error, 'Error', {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            });
        }
    });
}