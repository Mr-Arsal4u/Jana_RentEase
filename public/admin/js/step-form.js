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
    let formData = {
        property_no: $("#property_no").val(),
        property_name: $("#property_name").val(),
        location: $("#location").val(),
        zip_code: $("#zip_code").val(),
        area: $("#area").val(),
        city: $("#city").val(),
        country: $("#country").val(),
        step: 1 
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
            console.log(response);
            nextPrev(1);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        }
    });
});


$("#property_details_next").click(function () {
    let formData = {
        property_no: $("#property_no").val(),
        bedrooms: $("#bedrooms").val(),
        bathrooms: $("#bathrooms").val(),
        description: $("#description").val(),
        max_persons: $("#max_persons").val(),
        view_side: $("#view_side").val(),
        step: 2 

    };

    $.ajax({
        url: "/add-property",
        method: "POST",
        data: formData,
        success: function (response) {
            console.log(formData);
            nextPrev(1);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        }
    });
});

$("#amenities_next").click(function () {

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
            console.log(response);
            nextPrev(1);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        }
    });
});


$("#documents_next").click(function (e) {
    e.preventDefault();
    var formData = new FormData($("#multiStepForm")[0]);
    formData.append('property_no', $("#property_no").val());

    $.ajax({
        url: '/property-images', 
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log("Images uploaded successfully");
            nextPrev(1);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
    });
});

$("#submitBtn").click(function () {
    nextPrev(1);
});


$('#imageUpload').on('change', function (event) {
    const files = event.target.files; // Get selected files
    const imagePreview = $('#imagePreview'); // Get image preview div

    // Clear previous preview
    imagePreview.empty();

    // Loop through selected files
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader(); // Create a new FileReader object

        // Function to handle FileReader load event
        reader.onload = function (event) {
            const imageElement = $('<img>'); // Create img element
            imageElement.addClass('preview-image'); // Add class for styling
            imageElement.attr('src', event.target.result); // Set src attribute with file data
            imageElement.css('width', '100px');
            imageElement.css('height', '100px');
            // Set width to 50px
            imageElement.on('click', function () {
                $(this).remove();
                // $(this).parent().remove();
                // Remove image when clicked
            });
            imagePreview.append(imageElement); // Append img element to preview div
        };

        // Read file as Data URL
        reader.readAsDataURL(file);
    }
});


