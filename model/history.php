<?php

require_once('database.php');

/**
 * Class Static History
 */
class History
{
    /*************************************
     * ----- SAVE HISTORY MEDIA -----
     *************************************/

    /**
     * Save the history's user for a new media.
     * @param int $userId The current user's id.
     * @param int $mediaId The media's id.
     * @param int $episodeId If the media's type is `Série`, set the episode id.
     */
    public static function saveHistoryMedia($userId, $mediaId, $episodeId = null) : void
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM history WHERE user_id = " . $userId . " AND media_id = " . $mediaId;
        if ($episodeId != null) {
            $sql .= " AND episode_id = " . $episodeId;
        }
        $req = $db->prepare($sql);
        $req->execute();
        $req->closeCursor();

        $sql = $req->rowCount() === 0 ?
            "INSERT INTO history
                (user_id, media_id, episode_id, lastTimeOpened, start_date, finish_date, watch_duration)
                VALUES (" . $userId . ", " . $mediaId . ", " . ($episodeId == null ? "NULL" : $episodeId) . ", CURRENT_TIMESTAMP, NULL, NULL, 0 ) "
            :
            "UPDATE history SET lastTimeOpened = CURRENT_TIMESTAMP WHERE
            user_id = " . $userId . " AND media_id = " . $mediaId .
            ($episodeId != null ? " AND episode_id = " . $episodeId : "");

        $req = $db->prepare($sql);
        $req->execute();
        $db = null;
    }

    /*************************************
     * ----- GET HISTORY BY USER ID -----
     *************************************/

    /**
     * @param int $userId The current user's id.
     * @return array An array with all user's history
     */
    public static function getHistoryByUserId($userId) : array
    {
        $db = init_db();
        $sql = "SELECT * FROM history WHERE user_id = " . $userId . " ORDER BY lastTimeOpened DESC";
        $req = $db->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    /*************************************
     * ----- DELETE HISTORY BY ID -----
     *************************************/

    /**
     * Delete a history with an id.
     * @param int $historyId The history's id.
     */
    public static function deleteHistoryById($historyId) : void
    {
        $db = init_db();
        $sql = "DELETE FROM history WHERE id = " . $historyId;
        $req = $db->prepare($sql);
        $req->execute();
    }

    /*****************************************
     * ----- DELETE HISTORIES BY USER ID -----
     ****************************************/

    /**
     * Delete all histories associate with an user.
     * @param int $userId
     */
    public static function deleteHistoriesByUserId($userId) : void
    {
        $db = init_db();
        $sql = "DELETE FROM history WHERE user_id = " . $userId;
        $req = $db->prepare($sql);
        $req->execute();
    }
}