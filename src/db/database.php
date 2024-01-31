<?php
class DatabaseHelper {
    public $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }  //connect to the database

    /**
     * User CRUD
     */

     public function insertUser($username, $name, $surname, $dateofbirth, $profileimage, $group, $email, $password, $salt, $bio, $fazzolettone, $specialita, $totem){
        $query = "
            INSERT INTO utente (username, nome, cognome, datadiNascita, immagineProfilo, gruppoappartenenza, mail, password, salt, bio, fazzolettone, specialita, totem)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
        //insert a new user
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssssssssss", $username, $name, $surname, $dateofbirth, $profileimage, $group, $email, $password, $salt, $bio, $fazzolettone, $specialita, $totem);
        $stmt->execute();

        return $username;
    }

    public function getUserByUsername($username) {
        $query = "
            SELECT username, immagineProfilo, nome, cognome, bio, fazzolettone, specialita, totem, gruppoappartenenza, datadiNascita, mail
            FROM utente 
            WHERE username = ?
        "; 
        //get all the user's data by username, except the password and the salt
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowerByUsername($username) {
        $query = "
            SELECT u.username, u.immagineProfilo
            FROM seguire s INNER JOIN utente u ON s.username_Follower = u.username
            WHERE s.username_seguito = ?
        ";
        //search for the followers of a user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //this function is not correct because we don't have name and surname mandatory
    public function searchUser($input) {
        $query = "
            SELECT username, immagineProfilo, nome, cognome, bio, fazzolettone, specialita, totem, gruppoappartenenza, datadiNascita, mail, 
            FROM utente 
            WHERE username LIKE CONCAT(?, '%') 
        "; 
        //get username's data of all the users that match the input

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $input);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsersByUsernameImageOnly($username) {
        $query = "
            SELECT username, immagineProfilo
            FROM utente 
            WHERE username LIKE ?
        ";
       //get username and immagineProfilo of all the users that match the input

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser($email, $name, $surname, $bio, $totem, $group, $dateofbirth, $username) {
        $query = "
            UPDATE utente
            SET mail = ?, nome = ?, cognome = ?, bio = ?, totem = ?, gruppoappartenenza = ?, datadiNascita = ?
            WHERE username = ?
        ";
        //update the user's data by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssssssss", $email, $name, $surname, $image, $bio, $fazzolettone, $specialita, $totem, $group, $dateofbirth, $username);
        $stmt->execute();
    }

    /** Funzione che non so se andremo ad usare, MOMENTANEA*/
    public function getUsersFriendsByusername ($username) {
        $query = "
            SELECT u.username, u.immagineProfilo
            FROM seguire s1
            INNER JOIN seguire s2 ON s1.username_seguito = s2.username_Follower AND s1.username_Follower = s2.username_seguito
            INNER JOIN utente u ON s1.username_Follower = u.username
            WHERE s1.username_seguito = ?;
        
        ";
        //search for the friends of a user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSeguitiByUsername($username) {
        $query = "
            SELECT s.username_seguito, u.immagineProfilo
            FROM seguire s INNER JOIN utente u ON s.Username_seguito = u.username
            WHERE s.Username_follower = ?
        ";
        //search for the followed users of a user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkFollow($usernameFollower, $usernameFollowed) {
        $query = "
            SELECT *
            FROM seguire
            WHERE username_follower = ? AND username_seguito = ?
        ";
        //search for the followers of a user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $usernameFollower, $username_seguito);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function unfollow($username_follower, $username_seguito) {
        $query = "
            DELETE FROM seguire
            WHERE username_follower = ? AND username_seguito = ?
        ";

        //unfollow an user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $username_seguito);
        $stmt->execute();
    }


    public function follow($username, $username_seguito) {
        $query = "
            INSERT INTO seguire (username_follower, username_seguito)
            VALUES (?, ?)
        ";
        //follow an user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $username_seguito);
        $stmt->execute();
    }

    public function getNotificationsByUsername($username) {
        $query = "
            SELECT *
            FROM Notifica
            WHERE username_receiver = ?
        ";
        //search for the notifications of a user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getUnreadNotificationsByUsername($username) {
        $query = "
            SELECT *
            FROM Notifica
            WHERE username_receiver = ? AND letta = false
        ";
        //search for the unread notifications of a user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function readNotification($idNotifica) {
        $query = "
            UPDATE notifica
            SET letta = 1
            WHERE idNotifica = ?
        ";
        //update the notification's letta by idNotification

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idNotifica);
        $stmt->execute();

        return $stmt->execute();
    }

    public function isReadNotification($idNotifica) {
        $query = "
            SELECT Letta
            FROM NOTIFICA
            WHERE IDNotifica = ?
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idNotifica);
        $stmt->execute();
        $stmt->bind_result($letta);
        $stmt->fetch();
    
        return (bool) $letta;
    }
    

    public function insertNotification($tipo, $usernameReceiver, $usernameSender, $letta) {
        $query = "
            INSERT INTO notifica (tipo, letta, username_receiver, username_sender)
            VALUES (?, ?, ?, ?)
        ";
        //insert a new notification

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("siss", $tipo, $letta, $usernameReceiver, $usernameSender);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function removeNotification($idNotifica) {
        $query = "
            DELETE FROM notifica
            WHERE idNotifica = ?
        ";
        //delete a notification by idNotification

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idNotifica);
        $stmt->execute();

        return $stmt->execute();
    }

    public function deleteReadNotifications() {
        $query = "
            DELETE FROM notifica
            WHERE letta = true
        ";
        //delete all the read notifications

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->execute();
    }

    public function getUsernameByIdPost($idPost) {
        $query = "
            SELECT username
            FROM post
            WHERE idPost = ?
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Utilizza fetch_assoc per ottenere un'associazione chiave-valore
        $row = $result->fetch_assoc();
    
        // Restituisci direttamente il valore dell'username
        return $row["username"];
    }
    

    public function insertPost($image, $username, $date, $text, $hashtag1, $hashtag2, $hashtag3) {
        $queryPost = "
            INSERT INTO post (immagine, username, data, testo, hashtag1, hashtag2, hashtag3) VALUES (?, ?, ?, ?, ?, ?, ?)
        ";
    
        $stmtPost = $this->db->prepare($queryPost);
        $stmtPost->bind_param("sssssss", $image, $username, $date, $text, $hashtag1, $hashtag2, $hashtag3);
        $success = $stmtPost->execute();
    
        // Restituisci un indicatore di successo o errore
        return $success;
    }
    
    

    public function updatePost($idPost, $text, $hashtag1, $hashtag2, $hashtag3) {
        $query = "
            UPDATE post
            SET testo = ?, hashtag1 = ?, hashtag2 = ?, hashtag3 = ?
            WHERE idPost = ?
        ";
        //update the post's data by idPost
        //WARNING: none of the parameters can be NULL, if you want to update only one of them, you have to pass the old value

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssisss", $text, $hashtag1, $hashtag2, $hashtag3, $idPost);  
        $success = $stmt->execute();

        return $success;
    }

    public function searchByHashtag($hashtag) {
        $query = "
            SELECT Idpost
            FROM post
            WHERE hashtag1 LIKE CONCAT (?, '%') OR hashtag2 LIKE CONCAT (?, '%') OR hashtag3 (?, '%')
        ";
        //get all the posts that have a certain hashtag

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $hashtag, $hashtag, $hashtag);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostByHashtag($hashtag) {
        $query = "
            SELECT idPost, immagine, username, data, testo, hashtag1, hashtag2, hashtag3
            FROM post
            WHERE hashtag1 = ? OR hashtag2 = ? OR hashtag3 = ?
        ";
        //get all the posts that have a certain hashtag

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $hashtag, $hashtag, $hashtag);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostByUsername($username) {
        $query = "
            SELECT idPost, immagine, username, data, testo, hashtag1, hashtag2, hashtag3
            FROM post
            WHERE username = ?
        ";
        //get all the posts of a user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostById($idPost) {
        $query = "
            SELECT idPost, immagine, username, data, testo, hashtag1, hashtag2, hashtag3
            FROM post
            WHERE idPost = ?
        ";
        //get all the posts of a user by idPost

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function showPostorderByDate($username) {
        $query = "
            SELECT *
            FROM post p, seguire s, utente u
            WHERE p.username = u.username AND u.username = s.Username_seguito AND s.Username_follower = ?
            ORDER BY data DESC
        ";
        //get all the posts ordered by date of the followed users by the username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    


    public function updateImgProfilo($username, $image) {
        $query = "
            UPDATE utente
            SET immagineProfilo = ?
            WHERE username = ?
        ";
        //update the user's image by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $image, $username);
        $stmt->execute();

        return $stmt->execute();
    }

    public function getSpecialita($username) {
        $query = "
            SELECT specialita
            FROM utente
            WHERE username = ?
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Utilizza fetch_assoc per ottenere un'associazione chiave-valore
        $row = $result->fetch_assoc();
    
        // Restituisci direttamente il valore della specialità
        return ($row !== null) ? $row["specialita"] : null;
    }
    

    public function updateSpecialita($username, $specialita) {
        $query = "
            UPDATE utente
            SET specialita = ?
            WHERE username = ?
        ";
        //update the user's specialita by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $specialita, $username);
        $stmt->execute();

        return $stmt->execute();
    }

    public function deleteSpecialita($username) {
        $query = "
            UPDATE utente
            SET specialita = NULL
            WHERE username = ?
        ";
        //delete the user's specialita by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->execute();
    }

    public function getFazzolettone($username) {
        $query = "
            SELECT fazzolettone
            FROM utente
            WHERE username = ?
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Utilizza fetch_assoc per ottenere un'associazione chiave-valore
        $row = $result->fetch_assoc();
    
        // Restituisci direttamente il valore della specialità
        return ($row !== null) ? $row["fazzolettone"] : null;
    }
    

    public function updateFazzolettone($username, $fazzolettone) {
        $query = "
            UPDATE utente
            SET fazzolettone = ?
            WHERE username = ?
        ";
        //update the user's fazzolettone by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $fazzolettone, $username);
        $stmt->execute();

        return $stmt->execute();
    }

    public function deleteFazzolettone($username) {
        $query = "
            UPDATE utente
            SET fazzolettone = NULL
            WHERE username = ?
        ";
        //delete the user's fazzolettone by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->execute();
    }

    public function getImageUser($username) {
        $query = "
            SELECT immagine
            FROM utente
            WHERE username = ?
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Utilizza fetch_assoc per ottenere un'associazione chiave-valore
        $row = $result->fetch_assoc();
    
        // Restituisci direttamente il valore dell'immagine
        return $row["immagine"];
    }
    

    public function getImageIdPost($idPost) {
        $query = "
            SELECT immagine
            FROM post
            WHERE idPost = ?
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Utilizza fetch_assoc per ottenere un'associazione chiave-valore
        $row = $result->fetch_assoc();
    
        // Restituisci il valore dell'immagine se esiste, altrimenti null
        return ($row !== null) ? $row['immagine'] : null;
    }
    
    
    public function deletePostImage($idPost) {
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

    //delete the post's image by idPost

    public function updatePostImage($idPost, $image) {
        $query = "
            UPDATE post
            SET immagine = ?
            WHERE idPost = ?
        ";
        //update the post's image by idPost

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $image, $idPost);
        $stmt->execute();

        return $stmt->execute();
    }

    public function deletePostById($idPost) {
        $query = "
            DELETE FROM post
            WHERE idPost = ?
        ";
        //delete the post's data by idPost
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
            SELECT u.username, u.immagineprofilo, c.idCommento, c.data, c.testo
            FROM commenti c INNER JOIN utente u ON c.username = u.username
            WHERE c.idPost = ?
            ORDER BY c.data DESC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertComment($text, $idPost, $username, $date) {
        $query = "
            INSERT INTO commenti (testo, idpost, username, data)
            VALUES (?, ?, ?, ?)
        ";
        //insert a new comment

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("siss", $text, $idPost, $username, $date);
        $stmt->execute();

        return $stmt->insert_id;
    }

    /**
     * Likes CRUD
     */

    public function getLikesByPostId($idPost) {
        $query = "
            SELECT COUNT(*) AS numeroLike
            FROM mipiace
            WHERE idPost = ?
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Utilizza fetch_assoc per ottenere un'associazione chiave-valore
        $row = $result->fetch_assoc();
    
        // Restituisci il valore del numero di like se esiste, altrimenti 0
        return ($row !== null) ? (int)$row['numeroLike'] : 0;
    }
    

    public function getLikesByUserAndPostId($username, $idPost) {
        $query = "
            SELECT COUNT(*) AS numeroLike
            FROM mipiace
            WHERE username = ? AND idPost = ?
        ";

        //this function controls if a user has liked a post by username and idPost, returns 1 if the user has liked the post, 0 otherwise

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $username, $idPost);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row["numeroLike"];
    }

    public function insertLike($idPost, $username_sender) {
        $query = "
            INSERT INTO mipiace (idPost, username)
            VALUES (?, ?)
        ";
        //insert a new like

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $idPost, $username_sender);
        $stmt->execute();
        $result = array("username" => $username_sender, "idPost" => $idPost);

        return $result;
    }

    public function removelike($idPost, $username) {
        $query = "
            DELETE FROM mipiace
            WHERE idPost = ? AND username = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $idPost, $username);
        $stmt->execute();

        return $stmt->execute();
    }

    /**
     * Notifications CRUD
     */

    
    /**
     * Login
     */

    public function checkLogin($username) {
        $query = "
            SELECT username, password, salt
            FROM utente
            WHERE username = ? 
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //funzione che inserisce un tentativo di login
    public function insertLoginAttempt($username, $time){
        $query = "
                INSERT INTO loginattempt (username, dataora)
                VALUES (?, ?)
                ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $time);
        $stmt->execute();

        return $stmt->insert_id;
    }

    //funzione che elimina i tentativi di login più vecchi di un certo tempo

    public function deleteLoginAttemptByTime($timeThd){
        $query = "
                DELETE FROM loginattempt
                WHERE dataora < ?
                ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $timeThd);
        $stmt->execute();

        return $stmt->execute();
    }

    public function getLoginAttempt($username, $timeThd){
        $query = "
                SELECT dataora 
                FROM loginattempt 
                WHERE username = ? AND dataora > ?
                ";
                //prendo tutti i tentativi di login di un utente che sono stati fatti dopo un certo tempo
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $username, $timeThd);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
?>