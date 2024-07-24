function bookingDates(propertyId) {
    $.ajax({
        url: '/property-bookings/' + propertyId,
        type: 'GET',
        success: function (response) {
            console.log(response);
            var today = new Date().toISOString().split('T')[0];
            $('#check_in_date').attr('min', today);
            $('#check_out_date').attr('min', today);
            $("#check_in_date").datepicker({
                minDate: 0, // Minimum selectable date is today
                beforeShowDay: function (date) {
                    var dateString = $.datepicker.formatDate('yy-mm-dd', date);
                    return [!isDateBooked(dateString, response)]; // Disable booked dates
                }
            });
            $("#check_out_date").datepicker({
                minDate: 0, // Minimum selectable date is today
                beforeShowDay: function (date) {
                    var dateString = $.datepicker.formatDate('yy-mm-dd', date);
                    return [!isDateBooked(dateString, response)]; // Disable booked dates
                }
            });
        }
    });
}

// Function to check if a date is booked
function isDateBooked(dateString, bookings) {
    for (var i = 0; i < bookings.length; i++) {
        var booking = bookings[i];
        if (dateString >= booking.check_in && dateString <= booking.check_out) {
            return true; // Date is booked
        }
    }
    return false; // Date is not booked
}

$('#search-property-button').click(function () {
    var city = $('#city').val();
    var checkIn = $('#check-in').val();
    var checkOut = $('#check-out').val();
    if (city.trim() === '' || checkIn.trim() === '' || checkOut.trim() === '') {
        $('#search-message').show();
        return; 
    } else {
        $('#search-message').hide(); 
    }
    $.ajax({
        route: "{{route('index')}}",
        type: 'GET',
        data: {
            city: city,
            check_in: checkIn,
            check_out: checkOut
        },
        success: function (response) {
            console.log(response);
                // $("#output").empty();
                $('#row-no-gutters').empty();
                $("#row-no-gutters").html(response.content.original.htmlContent);
                // updatePropertiesCards(response);

            $('html, body').animate({
                scrollTop: $('#apartment-section').offset().top
            }, 1000); //
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
    });
});
