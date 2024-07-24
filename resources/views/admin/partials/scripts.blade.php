<!-- Corrected Script Order and Removal of Duplicate CDNs -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ asset('admin/plugins/common/common.min.js') }}"></script>
<script src="{{ asset('admin/js/custom.min.js') }}"></script>
<script src="{{ asset('admin/js/settings.js') }}"></script>
<script src="{{ asset('admin/js/gleek.js') }}"></script>
<script src="{{ asset('admin/js/styleSwitcher.js') }}"></script>

<!-- Chart.js -->
<script src="{{ asset('admin/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<!-- Circle Progress -->
<script src="{{ asset('admin/plugins/circle-progress/circle-progress.min.js') }}"></script>

<!-- jQuery (ensure only one version is included) -->

<!-- Bootstrap (ensure only one version is included) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Stepform (you can uncomment if needed) -->

{{-- <script src="{{ asset('admin/plugins/jquery-steps/build/jquery.steps.min.js') }}"></script>  --}}
{{-- <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/js/plugins-init/jquery-steps-init.js') }}"></script> --}}
{{--  --}}
<!-- Datamap -->
<script src="{{ asset('admin/plugins/d3v3/index.js') }}"></script>
<script src="{{ asset('admin/plugins/topojson/topojson.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datamaps/datamaps.world.min.js') }}"></script>

<!-- Morris.js -->
<script src="{{ asset('admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>

<!-- Pignose Calendar -->
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>

<!-- Chartist.js -->
<script src="{{ asset('admin/plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ asset('admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

<!-- Dashboard -->
<script src="{{ asset('admin/js/dashboard/dashboard-1.js') }}"></script>

<!-- Step-form -->
<script src="{{ asset('admin/js/step-form.js') }}"></script>

<!-- Admin Filters -->
<script src="{{ asset('js/super_admin/admin-filters.js') }}"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<!-- Rooms Scripts -->
<script src="{{ asset('admin/js/rooms.js') }}"></script>
<script src="{{ asset('admin/js/roomType.js') }}"></script>
<script>
    CKEDITOR.replace('description');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <script>
    $(document).ready(function() {
        $('#addRoomButton').click(function() {
            $('#roomContainer').fadeIn('fast');
        });

        $(document).mouseup(function(e) {
            var container = $("#roomContainer");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.fadeOut('fast');
            }
        });
    });
</script> --}}
