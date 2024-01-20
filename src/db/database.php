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
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
        //insert a new user
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssssssssss", $username, $name, $surname, $dateofbirth, $profileimage, $group, $email, $password, $salt, $bio, $fazzolettone, $specialita, $totem);
        $stmt->execute();

        return $username;
    }

    public function getUsersByUsername($username) {
        $query = "
            SELECT username, immagineProfilo, nome, cognome, bio, fazzolettone, specialita, totem, gruppoappartenenza, datadiNascita, mail, 
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

    public function getSeguitiByUsername($username) {
        $query = "
            SELECT u.username_Seguito, u.immagineProfilo
            FROM seguire s INNER JOIN utente u ON s.username_Seguito = u.username
            WHERE s.username_Follower = ?
        ";
        //search for the followed users of a user by username

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
            OR nome LIKE CONCAT(?, '%') 
            OR cognome LIKE CONCAT(?, '%')
        "; 
        //get username's data of all the users that match the input

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $input, $input, $input);
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
    public function updateUser($email, $name, $surname, $image, $bio, $fazzolettone, $specialita, $totem, $group, $dateofbirth, $username) {
        $query = "
            UPDATE utente
            SET mail = ?, nome = ?, cognome = ?, immagineProfilo = ?, bio = ?, fazzolettone = ?, specialita = ?, totem = ?, gruppoappartenenza = ?, datadiNascita = ?
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

    public function getSeguitiById($username) {
        $query = "
            SELECT u.username_Seguito, u.immagineProfilo
            FROM seguire s INNER JOIN utente u ON s.username_Seguito = u.username
            WHERE s.username_Follower = ?
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
            WHERE username_receiver = ? AND letta = false
        ";
        //search for the notifications of a user by username

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isReadNotification($idNotifica) {
        $query = "
            UPDATE notifica
            SET letta = true
            WHERE idNotifica = ?
        ";
        //update the notification's letta by idNotification

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idNotifica);
        $stmt->execute();

        return $stmt->execute();
    }

    public function insertNotification($tipo, $usernameReceiver, $usernameSender, $letta) {
        $query = "
            INSERT INTO notifica (tipo, username_receiver, username_sender, Letta)
            VALUES (?, ?, ?, ?)
        ";
        //insert a new notification

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("issb", $tipo, $usernameReceiver, $usernameSender, $letta);
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





    

    public function getUsernameByIdPost($idPost) {
        $query = "
            SELECT username
            FROM post
            WHERE idPost = ?
        ";
        //get the username of the user that has posted a post by idPost

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    

   

    public function getPostById($idPost) {
        $query = "
        SELECT 
        u.username, u.immagineProfilo, 
        p.idPost, p.data, p.testo, p.immagine,
        GROUP_CONCAT(DISTINCT h.nometipo ORDER BY h.nometipo ASC) AS hashtag_list,
        COUNT(DISTINCT l.username) AS num_like,
        COUNT(DISTINCT c.idCommento) AS num_commenti,
        GROUP_CONCAT(DISTINCT c.testo ORDER BY c.data ASC) AS commenti_list
        FROM 
            post p 
        INNER JOIN 
            utente u ON p.username = u.username 
        LEFT JOIN 
            like l ON p.idPost = l.idPost
        LEFT JOIN 
            commenti c ON p.idPost = c.idPost
        LEFT JOIN 
            appartenere ph ON p.idPost = ph.idPost
        LEFT JOIN 
            hashtag h ON ph.nometipo = h.nometipo
        WHERE 
            p.idPost = ?
        GROUP BY 
            u.username, u.immagineProfilo,
            p.idPost, p.data, p.testo, p.immagine;
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    //get all the post's data by idPost

    public function getPostByHashtag ($hashtagName) {
        $query = "
        SELECT 
        u.username, u.immagineProfilo, 
        p.idPost, p.data, p.testo, p.immagine,
        GROUP_CONCAT(DISTINCT h.nome ORDER BY h.nometipo ASC) AS hashtag_list,
        COUNT(DISTINCT l.username) AS num_like,
        COUNT(DISTINCT c.idCommento) AS num_commenti,
        GROUP_CONCAT(DISTINCT c.testo ORDER BY c.data ASC) AS commenti_list
        FROM 
            post p 
        INNER JOIN 
            utente u ON p.username = u.username 
        LEFT JOIN 
            like l ON p.idPost = l.idPost
        LEFT JOIN 
            commenti c ON p.idPost = c.idPost
        LEFT JOIN 
            appartenere ph ON p.idPost = ph.idPost
        LEFT JOIN 
            hashtag h ON ph.nometipo = h.nometipo
        WHERE 
            h.nometipo = ?
        GROUP BY 
            u.username, u.immagineProfilo, 
            p.idPost, p.data, p.testo, p.immagine;
    
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $hashtagName);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    //get all the post's data by hashtag


    public function insertPost($image, $username, $date, $text, $hashtagArray) {
        // Inserimento del post
        $queryPost = "
        INSERT INTO post (immagine, username, data, testo) VALUES (?, ?, ?, ?)
        ";
        $stmtPost = $this->db->prepare($queryPost);
        $stmtPost->bind_param("ssss", $image, $username, $date, $text);
        $stmtPost->execute();
    
        // Recupero dell'ID del post appena inserito
        $idPostInserito = $stmtPost->insert_id;
    
        // Inserimento degli hashtag
        $queryHashtag = "
        INSERT INTO hashtag (nometipo) VALUES (?) ON DUPLICATE KEY UPDATE nometipo = nometipo
        ";
        $stmtHashtag = $this->db->prepare($queryHashtag);
        $stmtHashtag->bind_param("s", $hashtag);
    
        foreach ($hashtagArray as $hashtag) {
            $stmtHashtag->execute();
    
            // Associazione dell'hashtag al post
            $queryPostHashtag = "
            INSERT INTO appartenere (idPost, nometipo) VALUES (?, ?)
            ";
            $stmtPostHashtag = $this->db->prepare($queryPostHashtag);
            $stmtPostHashtag->bind_param("is", $idPostInserito, $hashtag);
            $stmtPostHashtag->execute();
            $stmtPostHashtag->close();
        }
    
        // Restituisci l'ID del post appena inserito
        return $idPostInserito;
    }
    //insert a new post
    
    

    public function updatePost($idPost, $text, $image) {
        $query = "
            UPDATE post
            SET testo = ?, immagine = ?
            WHERE idPost = ?
        ";
        //update the post's data by idPost

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssi", $text, $image, $idPost);
        $stmt->execute();

        return $stmt->execute();
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

    public function deletePostById($idPost) {
        $query = "
            DELETE FROM post
            WHERE idPost = ?
        ";
        //delete the post's data by idPost
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        var_dump($stmt->error); //is used for debugging purposes. It will output any error message from the last operation on $stmt.

        return true;
    }

    /**
     * Comments CRUD
     */
    //also this function is useless, because the number of comments is already calculated in the getPostById function and also
    //the list of comments is already given in the getPostById function
    public function getCommentsById($idPost) {
        $query = "
            SELECT u.username, u.immagineprofilo, c.idCommento, c.data, c.testo
            FROM commento c INNER JOIN utente u ON c.username = u.username
            WHERE c.idPost = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertComment($text, $username, $idPost, $date) {
        $query = "
            INSERT INTO commento (testo, username, idPost, data)
            VALUES (?, ?, ?, ?)
        ";
        //insert a new comment

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssis", $text, $username, $idPost, $date);
        $stmt->execute();

        return $stmt->insert_id;
    }

    /**
     * Likes CRUD
     */

    public function getLikesByPostId($idPost) {
        $query = "
            SELECT COUNT(*) AS numeroLike
            FROM like
            WHERE idPost = ?;
        
        ";
//return the number of likes of a post by idPost
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getLikesByUserAndPostId($username, $idPost) {
        $query = "
            SELECT COUNT(*) AS numeroLike
            FROM like
            WHERE username = ? AND idPost = ?
        ";

        //this function controls if a user has liked a post by username and idPost, returns 1 if the user has liked the post, 0 otherwise

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $username, $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertLike($idPost, $username_sender) {
        $query = "
            INSERT INTO like (idPost, username)
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
            DELETE FROM like
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

    public function checkLogin($username, $password) {
        $query = "
            SELECT *
            FROM utente
            WHERE username = ? AND password = ?
        ";
        //check if the username and the password are correct

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //funzione che inserisce un tentativo di login
    public function insertLoginAttempt($username, $time){
        $query = "
                INSERT INTO tentativoLogin (username, dataora)
                VALUES (?, ?)
                ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $dataora);
        $stmt->execute();

        return $stmt->insert_id;
    }

    //funzione che elimina i tentativi di login più vecchi di un certo tempo

    public function deleteLoginAttemptByTime($timeThd){
        $query = "
                DELETE FROM tentativoLogin
                WHERE dataora < ?
                ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $timeThd);
        $stmt->execute();

        return $stmt->execute();
    }

    

    public function getLoginAttempt($username, $timeThd){
        $query = "
                SELECT time 
                FROM tentativoLogin 
                WHERE username = ? AND dataora > ?
                ";
                //prendo tutti i tentativi di login di un utente che sono stati fatti dopo un certo tempo
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $username, $timeThd);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Register
     */


    

}
?>