// (function($) {
//     "use strict"

//     var form = $("#step-form-horizontal");
//     form.children('div').steps({
//         headerTag: "h4",
//         bodyTag: "section",
//         transitionEffect: "slideLeft",
//         autoFocus: true, 
//         transitionEffect: "slideLeft",
//         onStepChanging: function (event, currentIndex, newIndex)
//         {
//             form.validate().settings.ignore = ":disabled,:hidden";
//             return form.valid();
//         },
//         onInit: function(event, currentIndex) {
//             // Remove default buttons
//             $('.actions a').remove();
//         }
//     });

//     // Custom navigation buttons
//     $('#custom-next-account-details').on('click', function() {
//         if(form.valid()) {
//             form.steps('next');
//         }
//     });

//     $('#custom-prev-your-address').on('click', function() {
//         form.steps('previous');
//     });

//     $('#custom-next-your-address').on('click', function() {
//         if(form.valid()) {
//             form.steps('next');
//         }
//     });

//     $('#custom-prev-billing-details').on('click', function() {
//         form.steps('previous');
//     });

//     $('#custom-next-billing-details').on('click', function() {
//         if(form.valid()) {
//             form.steps('next');
//         }
//     });

//     $('#custom-prev-confirmation').on('click', function() {
//         form.steps('previous');
//     });

//     // Submit form via AJAX
//     $('#custom-submit').on('click', function() {
//         if(form.valid()) {
//             $.ajax({
//                 url: 'your-server-endpoint',
//                 method: 'POST',
//                 data: form.serialize(),
//                 success: function(response) {
//                     console.log(response);
//                 },
//                 error: function(jqXHR, textStatus, errorThrown) {
//                     console.error('An error occurred: ' + errorThrown);
//                 }
//             });
//         }
//     });

// })(jQuery);


// $(document).ready(function() {
//     $('#custom-next-account-details').click(function() {
//         $('#account-details-section').hide();
//         $('#your-address-section').show();
//     });

//     $('#custom-prev-your-address').click(function() {
//         $('#your-address-section').hide();
//         $('#account-details-section').show();
//     });

//     $('#custom-next-your-address').click(function() {
//         $('#your-address-section').hide();
//         $('#billing-details-section').show();
//     });

//     $('#custom-prev-billing-details').click(function() {
//         $('#billing-details-section').hide();
//         $('#your-address-section').show();
//     });

//     $('#custom-next-billing-details').click(function() {
//         $('#billing-details-section').hide();
//         $('#confirmation-section').show();
//     });

//     $('#custom-prev-confirmation').click(function() {
//         $('#confirmation-section').hide();
//         $('#billing-details-section').show();
//     });

//     $('#custom-submit').click(function() {
//         alert('Form submitted successfully!');
//         // You can add form submission code here
//     });
// });



// $(document).ready(function() {
//     var steps = ['Room Info', 'Room details Address', 'Billing Details', 'Confirmation'];
//     var currentStep = 0;
//     var $sections = ['#account-details-section', '#your-address-section', '#billing-details-section', '#confirmation-section'];

//     function updateStepIndicator() {
//         $('.step-indicator.active').removeClass('active');
//         $('.step-indicator li:nth-child(' + (currentStep + 1) + ') button').addClass('active');
//     }

//     function showSection(sectionId) {
//         $sections.forEach((id) => {
//             $(id).hide();
//         });
//         $(sectionId).show();
//     }

//     function nextStep() {
//         currentStep++;
//         if(currentStep >= steps.length) {
//             currentStep = 0; // Loop back to the first step
//         }
//         showSection($sections[currentStep]);
//         updateStepIndicator();
//     }

//     function prevStep() {
//         currentStep--;
//         if(currentStep < 0) {
//             currentStep = steps.length - 1; // Loop back to the last step
//         }
//         showSection($sections[currentStep]);
//         updateStepIndicator();
//     }

//     // Update step indicator on page load
//     updateStepIndicator();

//     // Attach click events
//     $('.next-step').on('click', function() {
//         nextStep();
//     });

//     $('.prev-step').on('click', function() {
//         prevStep();
//     });

//     // Example usage for custom buttons
//     $('#custom-next-account-details').on('click', function() {
//         nextStep();
//     });

//     $('#custom-prev-your-address').on('click', function() {
//         prevStep();
//     });

//     // Continue attaching event handlers for other custom buttons similarly...
// });



