
function propertyFilters() {
    var from = $("#from_date").val();
    var to = $("#to_date").val();
    var name = $("#property_name").val();

    $.ajax({
        url: '/properties',
        type: 'GET',
        data: {
            name: name,
            from: from,
            to: to,
        },
        success: function (response) {
            console.log(response);
            // $('#properties_table_body').empty();
            // $('#properties_table_body p').text('No records found');
            $("#properties_table_body tr").remove();
            $("#properties_table_body").append(response.data);
            // $(".paginationLinks").html(response.pagination);
         
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
    });
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


// function updatePropertiesCards(properties) {


//     // Loop through each property and generate HTML for the card
//     properties.forEach(function(property) {
//         var cardHtml = '<div class="col-lg-6">' +
//                             '<div class="room-wrap d-md-flex">' +
//                                 '<a href="#" class="img" style="background-image: url(images/room-1.jpg);"></a>' +
//                                 '<div class="half left-arrow d-flex align-items-center">' +
//                                     '<div class="text p-4 p-xl-5 text-center">' +
//                                         '<p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>' +
//                                         '<h3 class="mb-3"><a href="rooms.html">' + property.property_name + '</a></h3>' +
//                                         '<ul class="list-accomodation">' +
//                                             '<li><span>Max:</span>' + property.max_persons + '</li>' +
//                                             '<li><span>Size:</span>' + property.area + ' SQFT</li>' +
//                                             '<li><span>View:</span>' + property.view_side + '</li>' +
//                                             '<li><span>Bed:</span>' + property.bedrooms + '</li>' +
//                                         '</ul>' +
//                                         '<p class="pt-1"><a id="book_apartment" onclick="bookProperty(' + property.id + ')" class="btn-custom px-3 py-2">View Room Details <span class="icon-long-arrow-right"></span></a></p>' +
//                                     '</div>' +
//                                 '</div>' +
//                             '</div>' +
//                         '</div>';
        
//         // Append the card HTML to the row
//         $('#apartment-section .row').append(cardHtml);
//     });
// }
