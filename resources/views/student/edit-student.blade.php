<div class="modal fade" id="EDITStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="UpdateStudentFORM" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="text" name="edit_id" id="edit_id">
                    <ul class="alert alert-warning d-none" id="update_errorList"></ul>

                    <div class="form-group mb3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control">
                    </div>

                    <div class="form-group mb3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="edit_email" class="form-control">
                    </div>

                    <div class="form-group mb3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control">
                    </div>
                    <div class="form-group mb3">
                        <label for="name">Image</label><br>
                        <div id="imageId">

                        </div>
                        <input type="file" name="image" class="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
