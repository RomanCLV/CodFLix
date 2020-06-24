<?php

require_once('database.php');

class History
{
    public static function saveHistoryMedia ($userId, $mediaId, $episodeId = null) : void
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM history WHERE user_id = " . $userId . " AND media_id = " . $mediaId;
        if ($episodeId != null)
        {
            $sql .= " AND episode_id = " . $episodeId;
        }
        $req = $db->prepare($sql);
        $req->execute();
        $req->closeCursor();

        $sql = $req->rowCount() === 0 ?
         "INSERT INTO history
                (user_id, media_id, episode_id, lastTimeOpened, start_date, finish_date, watch_duration)
                VALUES (" . $userId . ", " . $mediaId . ", " . ($episodeId == null ? "NULL" : $episodeId) .", CURRENT_TIMESTAMP, NULL, NULL, 0 ) "
        :
        "UPDATE history SET lastTimeOpened = CURRENT_TIMESTAMP WHERE
            user_id = " . $userId . " AND media_id = " . $mediaId .
            ($episodeId != null ? " AND episode_id = " . $episodeId : "");

        $req = $db->prepare($sql);
        $req->execute();
        $db = null;
    }

    public static function getHistoryByUserId($userId) : array
    {
        $db = init_db();
        $sql = "SELECT * FROM history WHERE user_id = " . $userId . " ORDER BY lastTimeOpened DESC";
        $req = $db->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public static function dropHistoryById($historyId) : void
    {
        $db = init_db();
        $sql = "DELETE FROM history WHERE id = " . $historyId;
        $req = $db->prepare($sql);
        $req->execute();
    }

    public static function dropHistoriesByUserId($userId) : void
    {
        $db = init_db();
        $sql = "DELETE FROM history WHERE user_id = " . $userId;
        $req = $db->prepare($sql);
        $req->execute();
    }
}