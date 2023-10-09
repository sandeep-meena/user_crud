<?php
$action = $_REQUEST['action'];

if (!empty($action)) {

    require_once 'includes/User.php';
    require_once 'includes/Address.php';

    $obj = new User();
    $obj1 = new Address();
}

if ($action == "adduser" && !empty($_POST)) {

    $uname = $_POST['username'];
    $active = $_POST['active'];

    $userid = (!empty($_POST['userid'])) ? $_POST['userid'] : '';

    $userData = [
        'username' => $uname,
        'active' => $active,
    ];

    if ($userid) {
        $obj->updateUser($userData, $userid);
    } else {

        $userid = $obj->addUser($userData);
    }

    if (!empty($userid)) {
        $user = $obj->getSingleUser('user_id', $userid);
        echo json_encode($user);
        exit();
    }
}

if ($action == "getusers") {
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $users = $obj->getUsers();

    if (!empty($users)) {
        $userList = $users;
    } else {
        $userList = [];
    }

    echo json_encode($userList);
    exit();
}

if ($action == "getuser") {
    $userId = (!empty($_GET['user_id'])) ? $_GET['user_id'] : '';

    if (!empty($userId)) {

        $user = $obj->getSingleUser('user_id', $userId);
        echo json_encode($user);
        exit();
    }
}
if ($action == "deleteuser") {
    $userId = (!empty($_GET['user_id'])) ? $_GET['user_id'] : '';

    if (!empty($userId)) {

        $isDeleted = $obj->deleteUser($userId);
        if ($isDeleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }
}


//address

if ($action == "addAddress" && !empty($_POST)) {

    $address = $_POST['address'];
    $userid = $_POST['user_id'];
    $default = $_POST['is_default'];


    $user_address_id = (!empty($_POST['addressid'])) ? $_POST['addressid'] : '';

    $addressData = [
        'user_id' => $userid,
        'user_address' => $address,
        'is_default' => $default,
    ];

    // if ($user_address_id) {
    //     $obj->updateUser($addressData, $user_address_id);
    // } else {

    $user_address_id = $obj1->addAddress($addressData);
    // }

    if (!empty($user_address_id)) {
        $address = $obj1->getSingleAddress('user_address_id', $user_address_id);
        echo json_encode($address);
        exit();
    }


    if ($action == "getAddress") {
        $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $address = $obj1->getAddress();

        if (!empty($address)) {
            $addressList = $address;
        } else {
            $addressList = [];
        }

        echo json_encode($addressList);
        exit();
    }
}
