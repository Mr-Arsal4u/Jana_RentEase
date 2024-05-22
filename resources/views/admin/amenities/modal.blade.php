
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Amenity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('amenities.save')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Amenity:</label>
              <input type="text" class="form-control" name="name" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Description:</label>
              <textarea class="form-control" name="description" id="message-text"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn mb-1 btn-rounded btn-success" data-dismiss="modal">Close</button>
          <button type="submit" class="btn mb-1 btn-rounded btn-danger">Save</button>
        </div>
    </form>

      </div>
    </div>
  </div>