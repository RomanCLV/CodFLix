<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/signupView.php');
  else:
    require('view/homeView.php');
  endif;

}

/***************************
* ----- SIGNUP FUNCTION -----
***************************/

function signUpUser() {
    $newUser = new User();
    $error_msg = null;
    $success_msg = null;
    try
    {
        $newUser->setEmail($_POST["email"]);
        $newUser->setPassword($_POST["password"], $_POST["password_confirm"]);
        $success_msg = $newUser->createUser() ? "Un mail d'activation s'est envoyé" : "Le mail d'activation n'a pas pu être envoyé";
    }
    catch (Exception $e)
    {
        $error_msg = $e->getMessage();
    }
    finally
    {
        return array("success_msg" => $success_msg, "error_msg" => $error_msg);
    }
}
