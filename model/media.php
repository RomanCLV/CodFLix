<?php

require_once('database.php');

/**
 * Class Media
 * @property int $id;
 * @property int $genre_id;
 * @property string $title;
 * @property string $type;
 * @property string $status;
 * @property string $release_date;
 * @property string $summary;
 * @property string $trailer_url;
 */
class Media
{
    protected int $id;
    protected int $genre_id;
    protected string $title;
    protected string $type;
    protected string $status;
    protected string $release_date;
    protected string $summary;
    protected string $trailer_url;

    /***************************
     * ----- CONSTRUCTOR -------
     ***************************/

    public function __construct($media)
    {
        $this->setId(isset($media->id) ? $media->id : null);
        $this->setGenreId($media->genre_id);
        $this->setTitle($media->title);
    }

    /***************************
     * -------- SETTERS ---------
     ***************************/

    public function setId($id) : void
    {
        $this->id = $id;
    }

    public function setGenreId($genre_id) : void
    {
        $this->genre_id = $genre_id;
    }

    public function setTitle($title) : void
    {
        $this->title = $title;
    }

    public function setType($type) : void
    {
        $this->type = $type;
    }

    public function setStatus($status) : void
    {
        $this->status = $status;
    }

    public function setReleaseDate($release_date) : void
    {
        $this->release_date = $release_date;
    }

    /***************************
     * -------- GETTERS ---------
     ***************************/

    public function getId() : int
    {
        return $this->id;
    }

    public function getGenreId() : int
    {
        return $this->genre_id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getStatus() : string
    {
        return $this->status;
    }

    public function getReleaseDate() : string
    {
        return $this->release_date;
    }

    public function getSummary() : string
    {
        return $this->summary;
    }

    public function getTrailerUrl() : string
    {
        return $this->trailer_url;
    }

    /***************************
     * ----- FILTER MEDIAS -----
     ***************************/

    /**
     * Get all medias which name contains title searched.
     * @param string $title The title searched.
     * @return array An array with the medias.
     */
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

    /*****************************
     * ----- GET MEDIA BY ID -----
     ****************************/

    /**
     * Get a media by its id.
     * @param int $id The media's id;
     * @return mixed
     */
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

    /************************************
     * ----- GET MEDIA GENDER BY ID -----
     ************************************/

    /**
     * Get the media's gender by its id.
     * @param int $id The genre's id;
     * @return mixed
     */
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

    /******************************
     * ----- GET ALL SEASONS -----
     *****************************/

    /**
     * Get all seasons of a serie.
     * @param int $serie_id The serie's id.
     * @return array An array with as many lines as there are seasons
     */
    public static function getAllSeasons($serie_id) : array
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

    /****************************************
     * ----- GET ALL EPISODES OF SEASON -----
     ***************************************/

    /**
     * @param int $serie_id Serie's id.
     * @param int $saison Season number.
     * @return array An array with all episodes associate with a season.
     */
    public static function getAllEpisodesOfSeason($serie_id, $saison) : array
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

    /*************************
     * ----- GET EPISODE -----
     ************************/

    /**
     * Get an episode associate to a serie, its season, and the wanted episode.
     * @param int $serie_id The serie's id.
     * @param int $saison The season number.
     * @param int $episode The episode number.
     * @return mixed
     */
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

    /*******************************
     * ----- GET EPISODE BY ID -----
     ******************************/

    /**
     * Get an episode by its id.
     * @param int $episode_id The episode's id.
     * @return mixed
     */
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
