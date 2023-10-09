<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add/Edit User <i class="fa fa-user-circle-o" aria-hidden="true"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addform" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">UserName:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Active</label>
                        <div class="input-group mb-3">
                            yes
                            <input type="radio" class="form-control" id="active" value="yes" name="active" required="required">No
                            <input type="radio" class="form-control" id="active" value="no" name="active" required="required">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="addButton">Submit</button>
                    <input type="hidden" name="action" value="adduser">
                    <input type="hidden" name="userid" id="userid" value="">
                </div>
            </form>
        </div>
    </div>
</div>