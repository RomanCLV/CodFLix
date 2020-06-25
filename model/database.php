<?php

/*************************************
 * ----- INIT DATABASE CONNECTION -----
 *************************************/

/**
 * @param int $port The localhost port. Set to 3306 by default.
 * @return PDO An object to dialog with database `codflix`. The host is localhost:3306.
 */
function init_db($port = 3306) : PDO
{
    try {
        $host = 'localhost:' . $port;
        $dbname = 'codflix';
        $charset = 'utf8';
        $user = 'root';
        $password = '';

        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password);

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $db;
}
