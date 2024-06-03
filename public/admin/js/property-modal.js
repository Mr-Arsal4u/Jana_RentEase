function propertyModal(id) {
    propertyId = id;
    var csrfToken = $('meta[name="csrf-token"]').attr("content");


    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    });

    $.ajax({
        
        url: window.location.href,
        method: "GET",
        data: { id: id },
        success: function(response) {
            console.log(response.property.amenities);
            // console.log(response.property.property_amount.currency);
            // console.log(response.property.property_amount.total_amount);
            // console.log(response.property.property_amount.currency.code);
            // console.log(response.property.description + response.property.PropertyAmount.currency.code + ' ' + response.property.location + ' ' + response.property.bedrooms + ' ' + response.property.bathrooms + ' ' + response.property.area + ' ' + response.property.max_persons + ' ' + response.property.view_side + ' ' + response.property.city + ' ' + response.property.zip_code + ' ' + response.property.country); ;
            $('#property-name').text(response.property.property_name);
            $('#property-description').text('Description:'+ response.property.description);
            $('#property-location-details').html('City: ' + (response.property.city ? response.property.city : 'N/A') + ', Zip Code: ' + (response.property.zip_code ? response.property.zip_code : 'N/A') + ', Country: ' + (response.property.country ? response.property.country : 'N/A'));
            $('#property-location').html('Location: ' + (response.property.location ? response.property.location : 'N/A') + ', Bedrooms: ' + (response.property.bedrooms ? response.property.bedrooms : 'N/A'));
            $('#property-bathroom-area').html('Bathrooms: ' + (response.property.bathrooms ? response.property.bathrooms : 'N/A') + ', Area: ' + (response.property.area ? response.property.area + ' sq ft' : 'N/A'))
            $('#property-max-view').html('Max Persons: ' + (response.property.max_persons ? response.property.max_persons : 'N/A') + ', View Side: ' + (response.property.view_side ? response.property.view_side : 'N/A'));
            // $('#property-price').text('Price P/N: ' + response.property.property_amount.total_amount + response.property.property_amount.currency.code);
            
            
            var amenitiesHtml = '';
            response.property.amenities.forEach(function(amenity, index) {
                if (index % 2 === 0) {
                    amenitiesHtml += '<p>';
                }
                amenitiesHtml += amenity.name + ' (' + amenity.description + ')';
                if (index % 2 === 1 || index === response.amenities.length - 1) {
                    amenitiesHtml += '</p>';
                }
                // console.log(amenity);
            });
            $('#amenities').html(amenitiesHtml);
        },
        
        error: function (xhr, status, error) {
            console.error("Error: " + error);
        },
        complete: function () {
            
            $("#loading-spinner").css("display", "none");
        }
    });
    


    function showModal() {
        $('#bookingModal').show();
        $('body').css('overflow', 'hidden'); 
    }

    
    function hideModal() {
        $('#bookingModal').hide();
        $('body').css('overflow', ''); 
    }

    
    function showDetailsBg() {
        $('.details-bg').show();
        $('.gallery-bg').hide();
        $('#bookingForm').show();
        $('#imgGallery').hide();
    }

    
    function showGalleryBg() {
        $('.details-bg').hide();
        $('.gallery-bg').show();
        $('#bookingForm').hide();
        $('#imgGallery').show();
    }

    
    showDetailsBg();

    
    $('.detailsImg').click(showDetailsBg);
    $('.galleryImg').click(showGalleryBg);

    
    function handleDetailsImgClick() {
        
        $('.detailsImg').removeClass('selected');
        $('.galleryImg').removeClass('selected');

        
        $(this).addClass('selected');
    }

    
    function handleGalleryImgClick() {
        
        $('.detailsImg').removeClass('selected');
        $('.galleryImg').removeClass('selected');

        
        $(this).addClass('selected');
    }

    
    $('.detailsImg').click(handleDetailsImgClick);
    $('.galleryImg').click(handleGalleryImgClick);

    
    $(document).click(function (event) {
        if ($(event.target).is('#bookingModal')) {
            hideModal();
        }
    });

    
    $(document).keydown(function (event) {
        if (event.key === 'Escape') {
            hideModal();
        }
    });


    
    showModal();

}
var propertyId; 

function validateTime(input) {
    
    var value = $(input).val();

    
    var numericValue = value.replace(/\D/g, '');

    
    if (numericValue.length > 2) {
        
        numericValue = numericValue.substring(0, 2);
    }

    
    var intValue = parseInt(numericValue);

    
    if (intValue > 12) {
        intValue = 12; 
    }

    
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

    
    var isEmpty = Object.values(formData).some(value => value === '');
    if (isEmpty) {
        $("#required-message").css("display", "block");
        return; 
    }

    $("#loading-spinner").css("display", "block");

    
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
            
            $("#loading-spinner").css("display", "none");
        }
    });
});
