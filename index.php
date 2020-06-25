<?php

require_once('controller/homeController.php');
require_once('controller/loginController.php');
require_once('controller/signupController.php');
require_once('controller/mediaController.php');
require_once('controller/activationController.php');
require_once('controller/historyController.php');
require_once('controller/contactUsController.php');
require_once('controller/accountController.php');
require_once('controller/notFoundController.php');

/***************************
 * ----- HANDLE ACTION -----
 ***************************/

if (isset($_GET['action'])):

    switch ($_GET['action']):

        case 'login':
            if (!empty($_POST))
                login($_POST);
            else
                loginPage();
            break;

        case 'signup':
            signupPage();
            break;

        case 'activation':
            activationPage();
            break;

        case 'logout':
            logout();
            break;

        case 'media':
            mediaPage();
            break;

        case 'history':
            historyPage();
            break;

        case 'contactus':
            contactUsPage();
            break;

        case 'myaccount':
            accountPage();
            break;

        default:
            notFoundPage();
            break;
    endswitch;

else:

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

    if ($user_id):
        mediaPage();
    else:
        homePage();
    endif;

endif;
