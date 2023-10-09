<?php
$action = $_REQUEST['action'];

if (!empty($action)) {

    require_once 'includes/User.php';
    $obj = new User();
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
