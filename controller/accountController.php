<?php

require_once('model/user.php');

/****************************
 * ----- LOAD ACCOUNT PAGE -----
 ****************************/

function accountPage() : void
{
    $user = new stdClass();
    $user->id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

    if (!$user->id):
        require('view/homeView.php');
    else:
        $userData = user::getUserById($_SESSION['user_id']);
        $user = new User();
        $user->setId($userData["id"]);
        $user->setEmail($userData["email"]);
        $user->setPassword($userData["password"], $userData["password"]);
        $user->setIsActive($userData["isActive"]);

        echo "<p>UserData : </p>";
        foreach ($userData as $key => $value) {
            echo "<p> key : $key --- value : $value </p>";
        }
        echo "<p>User : </p>";
        echo "<p>$user</p>";

        echo "<p>----------------</p>";

        require('view/accountView.php');
    endif;

}
