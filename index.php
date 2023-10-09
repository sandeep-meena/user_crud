<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User App</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="alert alert p-4 m-4" role="alert">
            <h4 class="text-center">User Details</h4>
        </div>

        <?php
        include_once 'form.php';
        include_once 'AddressForm.php';
        include_once 'userProfile.php';
        ?>



        <div class="row mb-3">
            <div class="col-3">
                <button type="button" class="btn btn-info" data-toggle="modal" id="addnewbtn" data-target="#userModal">Add New User <i class="fa fa-user-circle-o"></i></button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-info" data-toggle="modal" id="addAddressBtn" data-target="#AddressModal">Add Address <i class="fa fa-address-card-o"></i></button>
            </div>
        </div>

        <?php
        include_once 'usertable.php';
        ?>

    </div>
    <div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>

    </div>
    <div id="overlay" style="display:none;">
        <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
        <br />
        Loading...
    </div>
</body>

</html>