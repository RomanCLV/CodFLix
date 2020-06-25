<?php

require_once('database.php');

/**
 * Class User
 * @property int $id
 * @property string $email
 * @property string $password
 * @property bool $isActive
 */
class User
{
    protected int $id;
    protected string $email;
    protected string $password;
    protected bool $isActive;

    /***************************
     * ----- CONSTRUCTOR -------
     ***************************/

    public function __construct($user = null)
    {
        $this->isActive = false;
        if ($user != null):
            $this->setId(isset($user->id) ? $user->id : null);
            $this->setEmail($user->email);
            $this->setPassword($user->password, $user->password);
            $this->isActive = isset($user->isActive) ? $user->isActive : null;
        endif;
    }

    /***************************
     * -------- SETTERS ---------
     ***************************/

    public function setId($id) : void
    {
        $this->id = $id;
    }

    public function setEmail($email) : void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
            throw new Exception('Email incorrect');
        endif;
        $this->email = $email;
    }

    public function setPassword($password, $password_confirm) : void
    {
        if (strpos($password, " ") != false) {
            throw new Exception('Le mot de passe ne peut pas contenir d\'espace');
        }
        if (strlen($password) === 0) {
            throw new Exception('Vous devez entrez un mot de passe');
        }
        if ($password != $password_confirm):
            throw new Exception('Vos mots de passes sont différents');
        endif;

        //$this->password = $password;
        $this->password = hash('sha256', $password);
    }

    /***************************
     * -------- GETTERS ---------
     ***************************/

    public function getId() : int
    {
        return $this->id;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function getIsActive() : ?bool
    {
        return $this->isActive;
    }

    /***********************************
     * -------- CREATE NEW USER ---------
     ************************************/

    /**
     * @return bool Return true if a activation mail was send, else return false.
     * @throws Exception If the user already exists
     */
    public function createUser() : bool
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM user WHERE email = '" . $this->email . "'";
        // Check if email already exist
        $req = $db->prepare($sql);
        //$req->execute(array($this->getEmail()));
        $req->execute();
        if ($req->rowCount() > 0) {
            throw new Exception("Email ou mot de passe incorrect");
        }
        // Insert new user
        $req->closeCursor();
        $req = $db->prepare("INSERT INTO user ( email, password ) VALUES ( :email, :password )");
        $req->execute(array(
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ));
        // Close database connection
        $db = null;
        return $this->sendActivationMail();
    }

    /***************************************
     * -------- SEND ACTIVATION MAIL -------
     ***************************************/

    /**
     * Send an email with a link to active an user account.
     * @return bool if the mail was send or not
     */
    private function sendActivationMail() : bool
    {
        $userSql = $this->getUserByEmail();
        $userId = $userSql["id"];
        $link = "localhost:63342/codflix/index.php?action=activation&id=" . $userId;
        $message = "
        Bienvenue sur Cod'Flix,
        Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
        ou copier/coller dans votre navigateur Internet.\n". $link . "\n--------------- 
        Ceci est un mail automatique, Merci de ne pas y répondre.";

        return mail($this->getEmail(),
            "Activer votre compte Cod'Flix !",
            $message,
            "From: activation@codflix.com");
    }

    /******************************
     * -------- ACTIVATION --------
     *****************************/

    /**
     * Active an user account.
     * @param int $id The user's id.
     */
    public static function activationById($id) : void
    {
        // Open database connection
        $db = init_db();
        $sql = "UPDATE user SET `isActive`=1 WHERE id = " . $id;
        $req = $db->prepare($sql);
        //$req->execute(array($id));
         $req->execute();
        // Close database connection
        $db = null;
    }

    /**************************************
     * -------- GET USER DATA BY ID --------
     ***************************************/

    /**
     * Get a user by its id.
     * @param int $id The user's id.
     * @return mixed
     */
    public static function getUserById($id)
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM user WHERE id = '" . $id . "'";
        $req = $db->prepare($sql);
        //$req->execute(array($id));
        $req->execute();
        // Close database connection
        $db = null;
        return $req->fetch();
    }

    /***************************************
     * ------- GET USER DATA BY EMAIL -------
     ****************************************/

    /**
     * Get a user by its email.
     * @return mixed
     */
    public function getUserByEmail()
    {
        // Open database connection
        $db = init_db();
        $sql = "SELECT * FROM user WHERE email = '" . $this->getEmail() . "'";
        $req = $db->prepare($sql);
        //$req->execute(array($this->getEmail()));
        $req->execute();
        // Close database connection
        $db = null;
        return $req->fetch();
    }
}
