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
    try
    {
        $newUser->setEmail($_POST["email"]);
        $newUser->setPassword($_POST["password"], $_POST["password_confirm"]);
        $newUser->createUser();
        $error_msg = null;
    }
    catch (Exception $e)
    {
        $error_msg = $e->getMessage();
    }
    finally
    {
        return $error_msg;
    }
}