<?php

session_start();

require_once('model/user.php');

/****************************
 * ----- LOAD LOGIN PAGE -----
 ****************************/

function loginPage() : void
{
    $user = new stdClass();
    $user->id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

    if (!$user->id):
        require('view/auth/loginView.php');
    else:
        require('view/homeView.php');
    endif;

}

/***************************
 * ----- LOGIN FUNCTION -----
 ***************************/

function login($post) : void
{
    $data = new stdClass();
    $isValid = true;

    if (strlen($post['email']) == 0) {
        $error_msg = "Vous devez saisir un mail !";
        $isValid = false;
    }
    if (strpos($post['email'], " ") != false)
    {
        $error_msg = "Le mail ne doit pas contenir d'espace !";
        $isValid = false;
    }

    if ($isValid) {
        $data->email = $post['email'];
        $data->password = $post['password'];

        $user = new User($data);
        $userData = $user->getUserByEmail();

        $error_msg = "Email ou mot de passe incorrect";

        if ($userData && sizeof($userData) != 0):
            if ($user->getPassword() == $userData['password']):

                // Set session
                $_SESSION['user_id'] = $userData['id'];

                header('location: index.php ');
            endif;
        endif;
    }

    require('view/auth/loginView.php');
}

/****************************
 * ----- LOGOUT FUNCTION -----
 ****************************/

function logout() : void
{
    $_SESSION = array();
    session_destroy();

    header('location: index.php');
}
