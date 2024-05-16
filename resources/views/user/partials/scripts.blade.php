<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&sensor=false">
</script>
<script src="{{ asset('js/google-map.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

{{-- 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownToggle = document.querySelector('.dropdown-toggle');
        var dropdownMenu = document.querySelector('.dropdown-menu');

        dropdownToggle.addEventListener('mouseenter', function() {
            dropdownMenu.style.display = 'block';
        });

        dropdownToggle.addEventListener('click', function() {
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            } else {
                dropdownMenu.style.display = 'block';
            }
        });
    });
</script>




<script>
    // Get references to the images and background containers
    const detailsImg = document.querySelector('.detailsImg');
    const galleryImg = document.querySelector('.galleryImg');
    const detailsBg = document.querySelector('.details-bg');
    const galleryBg = document.querySelector('.gallery-bg');

    // Function to show the details background
    function showDetailsBg() {
        detailsBg.style.display = 'block';
        galleryBg.style.display = 'none';
    }

    // Function to show the gallery background
    function showGalleryBg() {
        detailsBg.style.display = 'none';
        galleryBg.style.display = 'block';
    }

    // Hide gallery background by default
    showDetailsBg();

    // Attach click event listeners to the images
    detailsImg.addEventListener('click', showDetailsBg);
    galleryImg.addEventListener('click', showGalleryBg);

    function handleDetailsImgClick() {
        // Remove the 'selected' class from all images
        detailsImg.classList.remove('selected');
        galleryImg.classList.remove('selected');

        // Add the 'selected' class to the details image
        detailsImg.classList.add('selected');
    }

    // Function to handle click on gallery image
    function handleGalleryImgClick() {
        // Remove the 'selected' class from all images
        detailsImg.classList.remove('selected');
        galleryImg.classList.remove('selected');

        // Add the 'selected' class to the gallery image
        galleryImg.classList.add('selected');
    }

    // Attach click event listeners to the images
    detailsImg.addEventListener('click', handleDetailsImgClick);
    galleryImg.addEventListener('click', handleGalleryImgClick);
</script>

<script>
    function validateTime(inputField) {
        // Get the current value
        let value = inputField.value;

        // Limit to only two digits
        if (value.length > 2) {
            inputField.value = value.slice(0, 2);
        }

        // Validate the entered value
        const regex = /^\d{1,2}$/; // Allows 1 or 2 digits
        if (!regex.test(value)) {
            inputField.value = ""; // Clear if not a valid number
        } else {
            // Check if total exceeds 12 (considering AM/PM)
            const period = document.querySelector('.time-select').value;
            const total = parseInt(value) + (period === 'PM' ? 12 : 0);
            if (total > 12) {
                inputField.value = ""; // Clear if total exceeds 12
            }
        }
    }
</script> --}}

<script>
    $(document).ready(function() {
       

        $("#check-in").datepicker();
        $("#check-out").datepicker();

        $('#slide-button').click(function(e) {
            e.preventDefault(); // Prevent the default action
            var targetSectionId = '#apartment-section'; // The ID of the section to show and scroll to
            var targetSection = $(targetSectionId);
            if (targetSection.is(':hidden')) {
                // Show the hidden section
                targetSection.show();
                // Scroll to the section
                $('html, body').animate({
                    scrollTop: targetSection.offset().top
                }, 1000); // Adjust the duration as needed
            }
        });


    });
</script>

<script>
    // JavaScript code to set property_id in the modal form
    document.addEventListener('DOMContentLoaded', function() {
        const viewRoomDetailsBtns = document.querySelectorAll('.view-room-details');
        const propertyIdInput = document.getElementById('property_id');

        viewRoomDetailsBtns.forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const propertyId = btn.dataset.propertyId;
                propertyIdInput.value = propertyId;
                showModal();
            });
        });
    });
</script>

<script>
    // Get reference to the modal and the button that triggers it
    const bookingModal = document.getElementById('bookingModal');
    const viewRoomDetailsBtns = document.querySelectorAll('.btn-custom');

    // Function to show the modal
    function showModal() {
        bookingModal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling on the background
    }

    // Function to hide the modal
    function hideModal() {
        bookingModal.style.display = 'none';
        document.body.style.overflow = ''; // Re-enable scrolling on the background
    }

    // Attach click event listeners to all "View Room Details" buttons
    viewRoomDetailsBtns.forEach(btn => {
        btn.addEventListener('click', showModal);
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === bookingModal) {
            hideModal();
        }
    });

    // Close the modal when pressing the Escape key
    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            hideModal();
        }
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/date.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    function bookProperty(id) {
           var name = $("#renter_name").val();
           var email = $("#renter_email").val();
           var phone = $("#renter_phone").val();
           var check_in = $("#check-in").val();
           var check_out = $("#check-out").val();
           var apartment_id = id;
           var adults = $("#adults").val();
           var children = $("#children").val();
           var time = $("#time").val();
           console.log(name, email, phone, check_in, check_out, apartment_id, adults, children, time);
           $.ajax({
               url: '/property-bookings/' + apartment_id,
               type: 'GET',
               data: {
                   name: name,
                   email: email,
                   // phone: phone,
                   check_in: check_in,
                   check_out: check_out,
                   apartment_id: apartment_id,
                   adults: adults,
                   children: children,
                   time: time
               },
               success: function(response) {
                   console.log(response);
                   alert('Booking successful!');
               },
               error: function(error) {
                   console.log(error);
                   alert('An error occurred. Please try again.');
               }
           });
       }
</script>