<!-- resources/views/admin/currencies/modal.blade.php -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Currency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('currency.save') }}" id="currencyForm">
                    @csrf
                    <div class="form-group">
                        <label for="currencyCode" class="col-form-label">Code:</label>
                        <input type="text" class="form-control" id="currencyCode" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="currencyName" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="currencyName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="currencyStatus" class="col-form-label">Status:</label>
                        <select class="form-control" id="currencyStatus" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveCurrencyBtn">Save</button>
            </div>
            </form>

        </div>
    </div>
</div>

{{-- <script>
    $(document).ready(function() {
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var modal = $(this);
            
            // If the button has data attributes for edit, populate the fields
            if (button.data('code')) {
                modal.find('.modal-title').text('Edit Currency');
                modal.find('#currencyCode').val(button.data('code'));
                modal.find('#currencyName').val(button.data('name'));
                modal.find('#currencyStatus').val(button.data('status'));
            } else {
                // Reset form for new currency creation
                modal.find('.modal-title').text('Create Currency');
                modal.find('#currencyForm')[0].reset();
            }
        });

        // Handle save button click
        $('#saveCurrencyBtn').click(function() {
            var formData = $('#currencyForm').serialize();
            $.ajax({
                url: '/currencies/save', // Your save URL
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success
                    location.reload(); // Reload the page to show changes
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });
        });
    });
</script> --}}
