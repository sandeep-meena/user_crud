<?php
require_once 'includes/User.php';
$obj = new User();
?>

<div class="modal fade" id="AddressModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Address <i class="fa fa-address-card-o" aria-hidden="true"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addAddressForm" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Address</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card-o" aria-hidden="true"></i>
                            </div>
                            <!-- <input type="text" class="form-control" id="address" name="address" required="required"> -->
                            <textarea name="address" id="address" cols="50" rows="10" placeholder="Enter a Address" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">select user</label>
                        <div class="input-group mb-3" style="width: 100%;" id="ADD">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card-o" aria-hidden="true"></i>
                            </div>
                            <!-- <input type="text" class="form-control" id="address" name="address" required="required"> -->
                            <select name="user_id" id="user_id">

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Default</label>
                        <div class="input-group mb-3">
                            <p>yes</p>
                            <input type="radio" class="form-control" id="is_default" value="yes" name="is_default" required="required">
                            <p>no</p>
                            <input type="radio" class="form-control" id="is_default" value="no" name="is_default" required="required">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="addButton">Submit</button>
                    <input type="hidden" name="action" value="addAddress">
                    <input type="hidden" name="addressid" id="addressid" value="">
                </div>
            </form>
        </div>
    </div>
</div>