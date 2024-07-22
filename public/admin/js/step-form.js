let currentStep = 0;
showStep(currentStep);

function showStep(step) {
    $(".step").eq(step).addClass("active");
    $(".step-header").eq(step).addClass("active");

    $(".step").not(":eq(" + step + ")").removeClass("active");
    $(".step-header").not(":eq(" + step + ")").removeClass("active");

    if (step == 0) {
        $("#prevBtn").hide();
    } else {
        $("#prevBtn").show();
    }

    if (step == $(".step").length - 1) {
        $("#nextBtn").text("Submit");
    } else {
        $("#nextBtn").text("Next");
    }
}

function nextPrev(n) {
    if (n == 1 && !validateForm()) return false;

    $(".step").eq(currentStep).removeClass("active");
    currentStep += n;

    if (currentStep >= $(".step").length) {
        $("#multiStepForm").submit();
        return false;
    }

    showStep(currentStep);
}

function goToStep(step) {
    currentStep = step;
    showStep(currentStep);
}

function validateForm() {
    let valid = true;
    let currentStepFields = $(".step.active :input");

    currentStepFields.each(function () {
        if ($(this).val() === "" && $(this).prop("required")) {
            $(this).addClass("is-invalid");
            valid = false;
        } else {
            $(this).removeClass("is-invalid");
        }
    });

    return valid;
}

$(document).on("input", ".step.active :input", function () {
    if ($(this).val() !== "") {
        $(this).removeClass("is-invalid");
    }
});

$("#property_info_next").click(function () {
    validateForm();
    let formData = {
        property_no: $("#property_no").val(),
        property_name: $("#property_name").val(),
        location: $("#location").val(),
        zip_code: $("#zip_code").val(),
        property_area: $("#property_area").val(),
        city: $("#city").val(),
        country: $("#country").val(),
        // step: 1,
        owner_id: $("#owner_id").val(),
        total_rooms: $("#rooms").val(),
    };
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/add-property",
        method: "POST",
        data: formData,
        success: function (response) {
            // console.log(response.original.status);
            if (response.original.status === "success") {
                nextPrev(1);
                toastr.success('Property info added Successfully!', 'Success', {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right toastr-black",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            }
        },
        error: function (xhr, status, error) {
            // console.log(xhr.responseJSON.message);
            console.log(xhr);

            toastr.error('Error: ' + xhr.responseJSON.message, 'Error', {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right toastr-black",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
            console.error("Error: " + error);
        }
    });
});


// $("#property_details_next").click(function () {
//     // Validate total room counts
//     let totalRooms = parseInt($('#rooms').val()) || 0;
//     let totalSelectedRooms = 0;

//     $('input[name^="roomCounts"]').each(function() {
//         totalSelectedRooms += parseInt($(this).val()) || 0;
//     });

//     if (totalSelectedRooms !== totalRooms) {
//         $('#error-message').show();
//         return false;
//     } else {
//         $('#error-message').hide();
//     }

//     // Gather form data
//     let formData = {
//         property_no: $("#property_no").val(),
//         total_rooms: $('#rooms').val(),
//         room_counts: {}
//     };

//     $('input[name^="roomCounts"]').each(function() {
//         formData.room_counts[$(this).attr('name').match(/\d+/)[0]] = $(this).val();
//     });

//     // AJAX request
//     $.ajax({
//         url: "/add-roomsCount",
//         method: "POST",
//         data: formData,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function (response) {
//             console.log(formData);
//             if (response.original.status === "success") {
//                 nextPrev(1);
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error("Error: " + error);
//         }
//     });
// });


$("#amenities_next").click(function () {
    // validateForm();

    var selectedAmenities = [];
    $('input[name^="amenity_"]:checked').each(function () {
        selectedAmenities.push($(this).val());
    });

    let formData = {
        property_no: $("#property_no").val(),
        amenities: selectedAmenities,
        step: 3
    };
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/property-amenities",
        method: "POST",
        data: formData,
        success: function (response) {
            if (response.status === "success") {
                toastr.success('Amenities added successfully!', 'Success', {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right toastr-black",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
                nextPrev(1);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
            toastr.error('Error : ' + 'Please Select Amenities', 'Error', {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right toastr-black",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        }
    });
});


$("#documents_next").click(function (e) {
    e.preventDefault();

    // Update CKEditor instances
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    // Get form inputs
    var images = $("#imageUpload").val();
    var description = $("#description").val();

    // Validate required fields
    if (!images || !description) {
        toastr.error('Please fill in all required fields.', 'Error', {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right toastr-black",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        });
        return;
    }

    // Proceed with form submission
    var formData = new FormData($("#multiStepForm")[0]);
    formData.append('property_no', $("#property_no").val());
    formData.append('description', description);
    formData.append('status', 'Complete');

    $.ajax({
        url: '/property-images',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);
            if (data.original.status === "success") {
                toastr.success('Property Created Successfully!', 'Success', {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right toastr-black",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
                $('#step4').remove();
                $('#success-container').show();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
            toastr.error('An error occurred while submitting the form.', 'Error', {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right toastr-black",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        }
    });
});


// $("#submitBtn").click(function () {
//     var formData = {
//         property_no: $("#property_no").val(),
//         currency: $('input[name="currency"]:checked').val(),
//         amount: $('#desiredAmount').val(),
//         status: 'Complete',
//     };

//     $.ajax({
//         url: '/submit-application',
//         type: 'POST',
//         data: formData,
//         dataType: 'json',
//         success: function (response) {
//             console.log(response);
//             // $('#step5').hide();
//             $('#step5').remove();
//             $('#success-container').show();
//         },
//         error: function (error) {
//             console.error('Error:', error);
//         }
//     });
// });


$('#imageUpload').on('change', function (event) {
    const files = event.target.files;
    const imagePreview = $('#imagePreview');

    imagePreview.empty();

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function (event) {
            const imageElement = $('<img>');
            imageElement.addClass('preview-image');
            imageElement.attr('src', event.target.result);
            imageElement.css('width', '100px');
            imageElement.css('height', '100px');
            // Set width to 50px
            imageElement.on('click', function () {
                $(this).remove();
                // $(this).parent().remove();
            });
            imagePreview.append(imageElement);
        };

        reader.readAsDataURL(file);
    }
});

$('.delete-property').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "Please type 'delete property' to confirm.",
        icon: 'warning',
        input: 'text',
        inputPlaceholder: 'Type "delete property"',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        preConfirm: (inputValue) => {
            if (inputValue === 'delete property') {
                return true;
            } else {
                Swal.showValidationMessage('You need to type "delete property" to confirm.');
                return false;
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/delete-property/' + id,
                type: 'DELETE', // Ensure your route accepts DELETE requests
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'The property has been deleted.',
                        icon: 'success'
                    });
                    // Optionally, you can refresh the page or remove the deleted item from the DOM
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while deleting the property.',
                        icon: 'error'
                    });
                }
            });
        }
    });
});

