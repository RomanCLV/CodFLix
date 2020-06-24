<?php

require_once('model/media.php');
require_once('model/history.php');

/***************************
 * ----- LOAD MEDIA PAGE -----
 ***************************/

function mediaPage(): void
{
    if (isset($_GET['media'])) {
        $mediaDetail = Media::getMediaById($_GET['media']);
        $mediaGender = Media::getMediaGenderById($mediaDetail["genre_id"]);

        if ($mediaDetail["type"] === "Série") {
            $episodeSelected = Media::getEpisode($mediaDetail["id"], $_GET["saison"], $_GET["episode"]);

            $result = Media::getAllSaisons($mediaDetail["id"]);
            $saisons = array();
            foreach ($result as $value) {
                array_push($saisons, $value["saison"]);
            }

            $result = Media::getAllEpisodesOfSaison($mediaDetail["id"], $_GET["saison"]);
            $episodes = array();
            foreach ($result as $value) {
                array_push($episodes, $value["name"]);
            }

            History::saveHistoryMedia($_SESSION["user_id"], $mediaDetail["id"], $episodeSelected["id"]);
        }
        else {
            History::saveHistoryMedia($_SESSION["user_id"], $mediaDetail["id"]);
        }

        require('view/mediaDetailsView.php');
    }
    else {
        $search = isset($_GET['title']) ? $_GET['title'] : null;
        $medias = Media::filterMedias($search);

        require('view/mediaListView.php');
    }
}
