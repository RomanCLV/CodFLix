<?php

require_once('database.php');

class User
{
    protected $id;
    protected $email;
    protected $password;
    protected $isActive;

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

    /**
     * @param int $id
     * @throws Exception
     */
    public function setId($id) : void
    {
        $this->id = $id;
    }

    /**
     * @param string $email
     * @throws Exception
     */
    public function setEmail($email) : void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
            throw new Exception('Email incorrect');
        endif;
        $this->email = $email;
    }

    /**
     * @param string $password
     * @param string $password_confirm
     * @throws Exception
     */
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

        $this->password = $password;
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

    public function createUser() : void
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
        if (!$this->sendActivationMail())
        {
            echo "<p>Le mail d'activation n'a pas pu être envoyé</p>";
        }
        else
        {
            echo "<p>Mail d'activation envoyé</p>";
        }
        // Close database connection
        $db = null;
    }

    /**************************************
     * -------- SEND ACTIVATION MAIL --------
     ***************************************/
    /**
     * @return bool if the mail was send or not
     */
    private function sendActivationMail() : bool
    {
        $userSql = $this->getUserByEmail();
        $userId = $userSql["id"];
        $link = "localhost:63342/ec-code-2020-codflix-php-master-master/index.php?action=activation&id=" . $userId;
        $message = "
        Bienvenue sur Cod'Flix,
        Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
        ou copier/coller dans votre navigateur Internet.\n". $link . "\n--------------- 
        Ceci est un mail automatique, Merci de ne pas y répondre.";

        return mail($this->getEmail(),
            "Activer votre compte Cod'Flix !",
            $message,
            "From: inscription@codflix.com");
    }

    /**************************************
     * -------- ACTIVATION --------
     ***************************************/
    public static function Activation($id) {
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

    public function __toString() : string
    {
        return "user : { " . $this->id . "," . $this->email . "," . $this->password . "}";
    }
}
