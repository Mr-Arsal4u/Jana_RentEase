function propertyModal(id) {
    propertyId = id;
    function showModal() {
        $('#bookingModal').show();
        $('body').css('overflow', 'hidden'); // Prevent scrolling on the background
    }

    // Function to hide the modal
    function hideModal() {
        $('#bookingModal').hide();
        $('body').css('overflow', ''); // Re-enable scrolling on the background
    }

    // Function to show the details background
    function showDetailsBg() {
        $('.details-bg').show();
        $('.gallery-bg').hide();
    }

    // Function to show the gallery background
    function showGalleryBg() {
        $('.details-bg').hide();
        $('.gallery-bg').show();
    }

    // Hide gallery background by default
    showDetailsBg();

    // Attach click event listeners to the images
    $('.detailsImg').click(showDetailsBg);
    $('.galleryImg').click(showGalleryBg);

    // Function to handle click on details image
    function handleDetailsImgClick() {
        // Remove the 'selected' class from all images
        $('.detailsImg').removeClass('selected');
        $('.galleryImg').removeClass('selected');

        // Add the 'selected' class to the details image
        $(this).addClass('selected');
    }

    // Function to handle click on gallery image
    function handleGalleryImgClick() {
        // Remove the 'selected' class from all images
        $('.detailsImg').removeClass('selected');
        $('.galleryImg').removeClass('selected');

        // Add the 'selected' class to the gallery image
        $(this).addClass('selected');
    }

    // Attach click event listeners to the images
    $('.detailsImg').click(handleDetailsImgClick);
    $('.galleryImg').click(handleGalleryImgClick);

    // Close the modal when clicking outside of it
    $(document).click(function (event) {
        if ($(event.target).is('#bookingModal')) {
            hideModal();
        }
    });

    // Close the modal when pressing the Escape key
    $(document).keydown(function (event) {
        if (event.key === 'Escape') {
            hideModal();
        }
    });


    // Show modal when the function is called
    showModal();

}
var propertyId; // Declare a global variable

function validateTime(input) {
    // Get the value entered in the input field
    var value = $(input).val();

    // Remove any non-numeric characters from the value
    var numericValue = value.replace(/\D/g, '');

    // Ensure that the numeric value has a maximum length of 2
    if (numericValue.length > 2) {
        // If the length exceeds 2, trim it to 2 digits
        numericValue = numericValue.substring(0, 2);
    }

    // Convert the numeric value to a number
    var intValue = parseInt(numericValue);

    // Ensure that the value is not greater than 12
    if (intValue > 12) {
        intValue = 12; // Set it to 12 if it exceeds 12
    }

    // Update the input field value with the validated numeric value
    $(input).val(intValue);
}


$("#check-in").datepicker();
$("#check-out").datepicker();


$("#check-btn").click(function (event) {
    event.preventDefault();

    var formData = {
        check_in: $("#check_in").val(),
        check_out: $("#check_out").val(),
        adults: $("#adults").val(),
        children: $("#children").val(),
        name: $("#name").val(),
        email: $("#email").val(),
        arrival_time: $("#arrival_time").val(),
        property_id: propertyId,
        period: $("#period").val(),
    };

    // Check if any field is empty
    var isEmpty = Object.values(formData).some(value => value === '');
    if (isEmpty) {
        $("#required-message").css("display", "block");
        return; 
    }

    $("#loading-spinner").css("display", "block");

    // Retrieve the CSRF token value
    var csrfToken = $('meta[name="csrf-token"]').attr("content");


    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    });

    $.ajax({
        url: "/booking",
        method: "POST",
        data: formData,
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
        complete: function () {
            // Hide the loading spinner after the AJAX request completes
            $("#loading-spinner").css("display", "none");
        }
    });
});
