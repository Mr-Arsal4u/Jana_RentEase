
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


function roomFilters() {
    var property_id = $("#property_id").val();
    var from = $("#from_date").val();
    var to = $("#to_date").val();
    var room_no = $("#room_no").val();
    var roomType = $("#room_type").val();

    $.ajax({
        url: '/rooms/' + property_id,
        type: 'GET',
        data: {
            from: from,
            to: to,
            roomType: roomType,
            room_no: room_no,
        },
        success: function (response) {
            console.log(response);
            // $('#properties_table_body').empty();
            // $('#properties_table_body p').text('No records found');
            $("#rooms_table_body tr").remove();
            $("#rooms_table_body").append(response.data);
            // $(".paginationLinks").html(response.pagination);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
    });
}











