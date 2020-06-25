<?php

require_once('model/history.php');

/**********************************
 * ----- LOAD HISTORY PAGE -----
 **********************************/

function historyPage()
{
    $user = new stdClass();
    $user->id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

    if (!$user->id):
        require('view/homeView.php');
    else:
        if (isset($_GET["delete"]))
        {
            History::deleteHistoryByIdAndUserId($_GET["delete"], $_SESSION["user_id"]);
            header('location: index.php?action=history ');
        }
        else if (isset($_GET["deleteall"]))
        {
            History::deleteHistoriesByUserId($_SESSION["user_id"]);
            header('location: index.php?action=history ');
        }
        else {
            $historySql = History::getHistoryByUserId($_SESSION["user_id"]);
            $history = array();
            $episodesIds = array();
            $watchDurations = array();
            foreach ( $historySql as $key => $value) {
                array_push($history, Media::getMediaById($value["media_id"]));
                array_push($episodesIds, $value["episode_id"]);
                array_push($watchDurations, $value["watch_duration"]);
            }

            require('view/historyView.php');
        }
    endif;
}
