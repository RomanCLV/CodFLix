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
        require('view/accountView.php');
    endif;

}
