<?php

require_once('database.php');

class Media
{
    protected $id;
    protected $genre_id;
    protected $title;
    protected $type;
    protected $status;
    protected $release_date;
    protected $summary;
    protected $trailer_url;

    public function __construct($media)
    {
        $this->setId(isset($media->id) ? $media->id : null);
        $this->setGenreId($media->genre_id);
        $this->setTitle($media->title);
    }

    /***************************
     * -------- SETTERS ---------
     ***************************/

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setGenreId($genre_id)
    {
        $this->genre_id = $genre_id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setReleaseDate($release_date)
    {
        $this->release_date = $release_date;
    }

    /***************************
     * -------- GETTERS ---------
     ***************************/

    public function getId()
    {
        return $this->id;
    }

    public function getGenreId()
    {
        return $this->genre_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getReleaseDate()
    {
        return $this->release_date;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function getTrailerUrl()
    {
        return $this->trailer_url;
    }

    /***************************
     * -------- GET LIST --------
     ***************************/

    public static function filterMedias($title) : array
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM media WHERE title LIKE " . '"%' . $title . '%"' . " ORDER BY release_date DESC";
        $req = $db->prepare($sql);
        //$req->execute( array( '%' . $title . '%' ));
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetchAll();
    }

    public static function getMediaById($id)
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM media WHERE id = " . $id;
        $req = $db->prepare($sql);
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    public static function getMediaGenderById($id)
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM genre WHERE id = " . $id;
        $req = $db->prepare($sql);
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    public static function getAllSaisons($serie_id)
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM series WHERE serie_id = " . $serie_id . " GROUP BY saison";
        $req = $db->prepare($sql);
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetchAll();
    }

    public static function getAllEpisodesOfSaison($serie_id, $saison) : array
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM series WHERE serie_id = " . $serie_id . " AND saison = " . $saison;
        $req = $db->prepare($sql);
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetchAll();
    }

    public static function getEpisode($serie_id, $saison, $episode)
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM series WHERE serie_id = " . $serie_id . " AND saison = " . $saison . " AND episode = " . $episode;
        $req = $db->prepare($sql);
        $req->execute();

        // Close database connection
        $db = null;
        return $req->fetch();
    }

    public static function getEpisodeById($episode_id)
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM series WHERE id = " . $episode_id;
        $req = $db->prepare($sql);
        $req->execute();

        // Close database connection
        $db = null;
        return $req->fetch();
    }
}
