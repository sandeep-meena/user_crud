function getUserRow(user) {
    var userRow = '';

    if (user) {
        userRow = ` <tr>
        <td class="align-middle">${user.user_id}</td>
        <td class="align-middle">${user.username}</td>
        <td class="align-middle">${user.active}</td>
           <td class="align-middle">
            <a href="#" class="btn btn-success mr-3 profile"  data-id="${user.user_id}" data-toggle="modal" data-target="#userViewModal" title="Prfile"><i class="fa fa-address-card-o" aria-hidden="true"> View</i></a>
        </td>
        <td class="align-middle">
            <a href="#" class="btn btn-warning  mr-3 edituser" data-toggle="modal" data-id="${user.user_id}" data-target="#userModal" title="Edit"><i class="fa fa-pencil-square-o fa-lg"></i></a>

        </td>
        <td class="align-middle">
            <a href="#"  class="btn btn-danger  deleteuser" data-id="${user.user_id}" data-userid="14" title="Delete"><i class="fa fa-trash-o fa-lg"></i></a>

        </td>

    </tr>`
    }
    return userRow;
}



function getAddress(add) {
    var addRow = '';

    if (add) {
        addRow = `${add.user_address}`
    }
    return addRow;
}


function gu(u) {
    var userRow = ''

    if (u) {
        userRow = `
        <option value="${u.user_id}">${u.username}</option>`
    }
    return userRow;
}


function getUsers() {


    $.ajax({
        url: "/user/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getusers" },
        beforSend: function () {
            $("#overlay").fadeIn();
        },
        success: function (rows) {

            if (rows) {
                // console.log(rows);
                var userslist = "";
                $.each(rows, function (index, user) {
                    userslist += getUserRow(user);

                });

                var userslist1 = "";
                $.each(rows, function (index, u) {
                    userslist1 += gu(u);

                });

                $('#userstable tbody').html(userslist);
                $('#ADD select').html(userslist1);
                $("#overlay").fadeOut();
            }


        },
        error: function () {
            console.log("something went wrong... !!!!");

        }
    });
}

//add user

$(document).ready(function () {
    $(document).on("submit", "#addform", function (event) {
        event.preventDefault();

        $.ajax({
            url: "/user/ajax.php",
            type: "POST",
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#overlay").fadeIn();
            },
            success: function (res) {
                console.log(res);
                if (res) {
                    $("#userModal").modal("hide");
                    $("#addform")[0].reset();
                    getUsers();
                    $("#overlay").fadeOut();
                }
            },
            error: function () {
                console.log("something went wrong !!!!");
            }
        });
    });

    $("#addnewbtn").on("click", function () {
        $("#addform")[0].reset();
        $("#userid").val("");
    })

    //edit user

    $(document).on("click", "a.edituser", function () {
        var userId = $(this).data("id");

        $.ajax({
            url: "/user/ajax.php",
            type: "GET",
            dataType: "json",
            data: { user_id: userId, action: "getuser" },
            beforSend: function () {
                $("#overlay").fadeIn();
            },
            success: function (user) {

                // console.log(user);
                if (user) {
                    $("#username").val(user.username);
                    $("#userid").val(user.user_id);
                }
                $("#overlay").fadeOut();


            },
            error: function () {
                console.log("something went wrong... !!!!");

            }
        });


    });

    //view profile

    $(document).on("click", "a.profile", function () {
        var userId = $(this).data("id");

        $.ajax({
            url: "/user/ajax.php",
            type: "GET",
            dataType: "json",
            data: { user_id: userId, action: "getuser" },
            beforSend: function () {
                $("#overlay").fadeIn();
            },
            success: function (user) {
                if (user) {

                    const profile = ` <div class="row">
    
                    <div class="col-sm-6 col-md-8">
                       <h4 class="text-primary">${user.username}</h4>
                       <p class"text-primary">Active : ${user.active}</p>

                       <h4 class="text-primary">Address</h4>
                     
                      </div>
                </div>`
                    $("#profile").html(profile);
                }

                $("#overlay").fadeOut();


            },
            error: function () {
                console.log("something went wrong... !!!!");

            }
        });


    });

    //deletuser

    $(document).on("click", "a.deleteuser ", function (e) {
        e.preventDefault()
        var userId = $(this).data("id");

        if (confirm("Are your sure want to delete this?")) {
            $.ajax({
                url: "/user/ajax.php",
                type: "GET",
                dataType: "json",
                data: { user_id: userId, action: "deleteuser" },
                beforSend: function () {
                    $("#overlay").fadeIn();
                },
                success: function (res) {
                    if (res) {

                        getUsers();
                        $("#overlay").fadeOut();
                    }
                },
                error: function () {
                    console.log("something went wrong... !!!!");

                }
            });
        }


    });



    //address

    $(document).on("submit", "#addAddressForm", function (event) {
        event.preventDefault();

        $.ajax({
            url: "/user/ajax.php",
            type: "POST",
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#overlay").fadeIn();
            },
            success: function (res) {
                console.log(res);
                if (res) {

                    $("#AddressModal").modal("hide");
                    $("#addAddressForm")[0].reset();
                    getUsers();
                    $("#overlay").fadeOut();
                }
            },
            error: function () {
                console.log("something went wrong !!!!");
            }
        });
    });

    function getAddress() {


        $.ajax({
            url: "/user/ajax.php",
            type: "GET",
            dataType: "json",
            data: { action: "getAddress" },
            beforSend: function () {
                $("#overlay").fadeIn();
            },
            success: function (rows) {

                if (rows) {
                    // console.log(rows);
                    console.log(rows);
                    var addresslist = "";
                    $.each(rows, function (index, add) {

                        addresslist += getAddress(add);

                    });

                    $('#Address').html(addresslist);
                    $("#overlay").fadeOut();
                }


            },
            error: function () {
                console.log("something went wrong... !!!!");

            }
        });
    }


    getUsers();
    getAddress();

});