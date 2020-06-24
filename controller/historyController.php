<?php

require_once('model/history.php');

/**********************************
 * ----- LOAD HISTORY PAGE -----
 **********************************/

function historyPage()
{
    if (isset($_GET["delete"]))
    {
        History::dropHistoryById($_GET["delete"]);
        header('location: index.php?action=history ');
    }
    else if (isset($_GET["deleteall"]))
    {
        History::dropHistoriesByUserId($_GET["deleteall"]);
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
}
