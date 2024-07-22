$(document).ready(function () {
    $('#addRoomsTypeForm').on('submit', function (e) {
        e.preventDefault();

        // let roomsCount = $('#rooms_count').val();
        // let leftRoomsCount = leftRoomsCounts;

        // if (parseInt(roomsCount) > parseInt(leftRoomsCount)) {
        //     $('#error-message').text('Rooms count should not be greater than left rooms count');
        //     $('#error-message').show();
        //     return;
        // } else {
        //     $('#error-message').hide();
        // }

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                if (response.status === 'success') {
                    $('#addRoomsTypeModal').modal('hide');
                    $("#roomTypeCount").text(response.roomTypeCount);
                    toastr.success('Room Type Created successfully!', 'Success', {
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
            error: function (jqXHR ,error,response) {
                
                console.log(jqXHR);
                toastr.error(jqXHR.responseJSON.message, 'Error', {
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

    $('#addRoomsTypeModal').on('hidden.bs.modal', function () {
        $('#addRoomsTypeForm')[0].reset();
        $('#error-message').hide();
    });
});