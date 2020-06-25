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

            $result = Media::getAllSeasons($mediaDetail["id"]);
            $saisons = array();
            foreach ($result as $value) {
                array_push($saisons, $value["saison"]);
            }

            $result = Media::getAllEpisodesOfSeason($mediaDetail["id"], $_GET["saison"]);
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
        $searchTitle = isset($_POST['title']) ? $_POST['title'] : null;
        $searchDate = isset($_POST['selectDate']) ? $_POST['selectDate'] : "after";
        $searchDateDay = isset($_POST['inputDate']) ? $_POST['inputDate'] : null;
        $searchGenre = isset($_POST['selectGender']) && $_POST['selectGender'] != 'null' ? $_POST['selectGender'] : null;
        $searchGenreId = null;
        $searchType = isset($_POST['selectType']) && $_POST['selectType'] != 'null'  ? $_POST['selectType'] : null;

        $types = Media::getAllMediaType();
        $genres = Media::getAllGenders();

        foreach ($genres as $key => $item) {
            if ($item["name"] === $searchGenre) {
                $searchGenreId = $item["id"];
                break;
            }
        }

        $medias = Media::filterMedias($searchTitle, $searchGenreId, $searchType, $searchDateDay, $searchDate);

        require('view/mediaListView.php');
    }
}
