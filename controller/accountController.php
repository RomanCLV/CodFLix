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

        if (isset($_POST["sendEmailActivation"])) {
            $user = new User();
            $user->setEmail($userData["email"]);
            $success_msg = $user->sendActivationMail() ?
                "Un mail d'activation s'est envoyé" :
                "Le mail d'activation n'a pas pu être envoyé";
        }
        else if (isset($_POST["changeEmail"])) {
            if (strlen($_POST["newEmail"]) === 0) {
                $error_changeMail_msg = "Veuillez saisir un email.";
            }
            if ($_POST["newEmail"] == $userData["email"] ) {
                $error_changeMail_msg = "Vous avez sélectionné votre email courant.";
            }
            if ($_POST["newEmail"] == $_POST["newEmailConfirm"] ) {
                $error_changeMail_msg = "Vos emails sont différents email.";
            }
            $user = new User();
            try {
                $user->setEmail($_POST["newEmail"]);
            }
            catch (Exception $e) {
                $error_changeMail_msg = "Mail incorrect.";
            }
            if ($user->getEmail() === $_POST["newEmail"]) {
                $user->setIsActive(false);
                $user->sendActivationMail();
            }
        }
        else if (isset($_POST["changePassword"])) {

        }

        require('view/accountView.php');
    endif;
}
