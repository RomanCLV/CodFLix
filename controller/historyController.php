<?php

require_once('model/history.php');

/**********************************
 * ----- LOAD HISTORY PAGE -----
 **********************************/

function historyPage()
{
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
