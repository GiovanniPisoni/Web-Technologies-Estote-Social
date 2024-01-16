<?php
class DatabaseHelper {
    public $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    /**
     * User CRUD
     */

    public function getUserById($userName) {
        $query = "
            SELECT userName, imgProfilo, nome, cognome, email, dataNascita, codCensismento, 
                gruppoApp, pw, scout, bio, fazzolettone, specialità, totem 
            FROM utente 
            WHERE userName = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc(MYSQLI_ASSOC);
    }

    public function serchUser($input) {
        $query = "
            SELECT userName, imgProfilo, nome, cognome,
            FROM utente 
            WHERE userName LIKE CONCAT(?, '%') 
            OR nome LIKE CONCAT(?, '%') 
            OR cognome LIKE CONCAT(?, '%')
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $input, $input, $input);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsersByUsername($slug) {
        $query = "
            SELECT userName, imgProfilo
            FROM utente 
            WHERE userName LIKE ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /** Funzione che non so se andremo ad usare, MOMENTANEA*/
    public function getUsersFriendsById ($userName) {
        $query = "
            SELECT u.userName, u.imgProfilo
            FROM seguire s INNER JOIN utente u ON s.userNameSeguito = u.userName
            WHERE s.userNameSeguace = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotificationsById($userName) {
        $query = "
            SELECT *
            FROM Notifica
            WHERE userName = ? AND letta = false
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSeguitiById($userName) {
        $query = "
            SELECT u.userNameSeguito, u.imgProfilo, u.nome, u.cognome
            FROM seguire s INNER JOIN utente u ON s.userNameSeguito = u.userName
            WHERE s.userNameSeguace = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSeguaciById($userName) {
        $query = "
            SELECT u.userNameSeguace, u.imgProfilo, u.nome, u.cognome
            FROM seguire s INNER JOIN utente u ON s.userNameSeguace = u.userName
            WHERE s.userNameSeguito = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkFollow($userName, $userNameFollowd) {
        $query = "
            SELECT *
            FROM seguire
            WHERE userName = ? AND userNameFollowed = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $userName, $userNameFollowed);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc(MYSQLI_ASSOC);
    }

    public function follow($userName, $userNameFollowed) {
        $query = "
            INSERT INTO seguire (userName, userNameFollowed)
            VALUES (?, ?)
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $userName, $userNameFollowed);
        $stmt->execute();
    }

    public function unfollow($userName, $userNameFollowed) {
        $query = "
            DELETE FROM seguire
            WHERE userName = ? AND userNameFollowed = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $userName, $userNameFollowed);
        $stmt->execute();
    }

    public function updateUserWithoutImg($username, $email, $nome, $cognome) {
        $query = "
            UPDATE utente
            SET email = ?, nome = ?, cognome = ?
            WHERE userName = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $email, $nome, $cognome, $username);
        $stmt->execute();
    }

    /**
     * post CRUD
    */

    public function getPostById($idPost) {
        $query = "
            SELECT u.userName, u.imgProfilo, u.nome, u.cognome, p.idPost, p.dataOra, p.testo, p.imgPost, p.like, p.commenti
            FROM post p INNER JOIN utente u ON p.userName = u.userName INNER JOIN hashtag h ON p.hastag = h.idHastag
            WHERE p.idPost = ?
            WHERE idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc(MYSQLI_ASSOC);
    }

    public function getPostByhashtag ($nomeHashtag) {
        $query = "
            SELECT u.userName, u.imgProfilo, u.nome, u.cognome, p.idPost, p.dataOra, p.testo, p.imgPost, p.like, p.commenti
            FROM post p INNER JOIN utente u ON p.userName = u.userName INNER JOIN hashtag h ON p.hastag = h.idHastag
            WHERE h.nome = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $nomeHashtag);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*METTERE UNA FUNZIONE CHE restituisce i dati del giorno e mese passati come parametro ??? */

    public function insertPost($idPost, $immagine, $hashtag, $utente) {
        $query = "
            INSERT INTO post (idPost, imgPost, hastag, userName)
            VALUES (?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isss", $idPost, $immagine, $hashtag, $utente);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function updatePostWhitImage($idPost, $testo, $immagine) {
        $query = "
            UPDATE post
            SET testo = ?, imgPost = ?
            WHERE idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssi", $testo, $immagine, $idPost);
        $stmt->execute();

        return $stmt->execute();
    }

    public function updatePostWithoutImage($idPost, $testo) {
        $query = "
            UPDATE post
            SET testo = ?
            WHERE idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $testo, $idPost);
        $stmt->execute();

        return $stmt->execute();
    }

    public function deletePostimage($idPost) {
        $query = "
            UPDATE post
            SET immagine = NULL
            WHERE idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();

        return $stmt->execute();
    }

    public function incrementCommentsById($idPost) {
        $query = "
            UPDATE post
            SET commenti = commenti + 1
            WHERE idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();

        return $stmt->execute();
    }

    public function decrementCommentsById($idPost) {
        $query = "
            UPDATE post
            SET commenti = commenti - 1
            WHERE idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();

        return $stmt->execute();
    }

    public function incrementLikesById($idPost) {
        $query = "
            UPDATE post
            SET like = like + 1
            WHERE idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();

        return $stmt->execute();
    }

    public function decrementLikesById($idPost) {
        $query = "
            UPDATE post
            SET like = like - 1
            WHERE idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();

        return $stmt->execute();
    }

    public function deletePostById($idPost) {
        $query = "
            DELETE FROM post
            WHERE idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();

        return $stmt->execute();
    }

    /**
     * Comments CRUD
     */

    public function getCommentsById($idPost) {
        $query = "
            SELECT u.userName, u.imgProfilo, u.nome, u.cognome, c.idCommento, c.dataOra, c.testo
            FROM commento c INNER JOIN utente u ON c.userName = u.userName
            WHERE c.idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertComment($idCommento, $testo, $utente, $idPost, $idNotifica) {
        $query = "
            INSERT INTO commento (idCommento, testo, userName, idPost, idNotifica)
            VALUES (?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("issi", $idCommento, $testo, $utente, $idPost, $idNotifica);
        $stmt->execute();

        return $stmt->insert_id;
    }

    /**
     * Likes CRUD
     */

    
}