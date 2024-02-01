<div class="container my-2 mt-5">
    <section class ="bg-white p-4 shadow-sm rounded-5" id="<?php echo $profile["user_id"]; ?>">
        <div class="row ms-1 mb-3 align-items-center">
            <div class="d-flex align-items-center">
                <?php if(isset($templateParams["utente"][0]["immagineProfilo"])): ?>
                    <div class="profile-image" style="background-image: url('img/<?= $templateParams["utente"][0]["immagineProfilo"] ?>');"></div>
                <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" heigth="70" fill="currentColor" class="bi bi-person-circle ms-6" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                <?php endif; ?>
                
                <div>
                    <p class="profileHead fw-bold h4 mt-1 mb-1"><?php echo $templateParams["utente"][0]["username"]; ?></p>
                </div>
            </div>
            <div class="col-10 px-2">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <p id="nomeCompleto" class="mb-1"><?php echo $templateParams["utente"][0]["nome"], " ", $templateParams["utente"][0]["cognome"]; ?></p>
                        </div>
                        <?php if($loggedUserId != $templateParams["utente"][0]["username"]): ?>
                            <div class="col align-self-center">
                                <button class="btn btn-success border-dark" id="seguiButton" type="button">Segui</button>
                            </div>
                        <?php endif; ?>
                            <div class="col align-items-center align-self-center d-flex justify-content-center">
                                <h1 class="profileHead h5">Post: <span><?php echo count($templateParams["userposts"]) ?></span></h1>
                            </div>
                            <div class="col align-items-center align-self-center d-flex justify-content-center">
                                <button id="follower" class="profileHead btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#userList-banner">
                                    Follower: <span id="numFollower"><?php echo count($templateParams["currentUserSeguaci"]); ?></span>
                                </button>
                            </div>
                            <div class="col align-items-center align-self-center d-flex justify-content-center">
                                <button id="seguiti" class="profileHead btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#userList-banner">
                                    Account seguiti: <span id="numSeguiti"><?php echo count($templateParams["currentUserSeguiti"]); ?></span>
                                </button>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-4 align-self-center">
                            <label class="profileHead fw-bolder">Bio:</label>
                            <p id="bio" class="profileHead"><?php echo $templateParams["utente"][0]["bio"]; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 align-self-center d-flex justify-content-center">
                            <?php if(isset($templateParams["utente"][0]["fazzolettone"])): ?>
                                <img src = "img/<?= $templateParams["utente"][0]["fazzolettone"] ?>" width="40" heigth="40" class="fluid-img rounded-circle overflow-hidden" alt = "Fazzolettone">
                            <?php else: ?>
                                <img src="img/fazzolettone.png" width="40" heigth="40" class="fluid-img rounded-circle overflow-hidden" alt="Fazzolettone">
                            <?php endif; ?>
                        </div>
                        <div class="col-4 align-self-center d-flex justify-content-center">
                            <?php if(isset($templateParams["utente"][0]["specialita"])): ?>
                                <img src = "img/<?= $templateParams["utente"][0]["specialita"] ?>" width="40" heigth="40" class="fluid-img rounded-circle overflow-hidden" alt = "Specialita">
                            <?php else: ?>
                                <img src="img/badge.png" width="40" heigth="40" class="fluid-img rounded-circle overflow-hidden" alt="Specialita">
                            <?php endif; ?>
                        </div>
                        <div class="col-4 align-self-center d-flex justify-content-center">
                            <?php if(isset($templateParams["utente"][0]["totem"])): ?>
                                <img src = "img/<?= $templateParams["utente"][0]["totem"] ?>" width="40" heigth="40" class="fluid-img rounded-circle overflow-hidden" alt = "Totem">
                            <?php else: ?>
                                <img src="img/totem.png" width="40" heigth="40" class="fluid-img rounded-circle overflow-hidden" alt="Totem">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class = "d-flex justify-content-center col-12">
            <hr class="text-dark w-100"/>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-grid" viewBox="0 0 16 16">
                    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"/>
                </svg>
            </div>
        </div>
        <div id="postContainer">
            <?php if(!empty($templateParams["userposts"])): ?>
                <?php foreach ($templateParams["userposts"] as $post): ?>
                    <article class="bg-light border border-dark my-4 px-4 pt-3 pb-1 rounded">
                        <!-- Profile image -->
                        <div class="row col text-start" id="<?php echo $post['idPost'] ?>">
                            <!-- Post date -->
                            <p class="ms-1 mt-1 mb-0 smaller-font">
                                <?php 
                                    $date = new DateTime($post["data"]);
                                    echo $date->format('d-m-Y');
                                ?>
                            </p>
                        </div>
                        <!-- Post image -->
                        <?php if(isset($post['immagine'])): ?>
                            <img src="./img/<?php echo $post['immagine'] ?>" alt="Post image" class="img-fluid rounded max-size-image">
                        <?php endif; ?>
                        <!-- Post text -->
                        <p class="mt-1 mb-0 fst-italic"><?php echo $post["testo"]; ?></p>
                        <!-- Hashtags -->
                        <div class="row">
                            <div class="col">
                                <?php if(isset($post['hashtag1']) || isset($post['hashtag2']) || isset($post['hashtag3'])): ?>
                                    <p class="smaller-font">
                                        <?php if(isset($post['hashtag1'])) echo $post['hashtag1'] . ' '; ?>
                                        <?php if(isset($post['hashtag2'])) echo $post['hashtag2'] . ' '; ?>
                                        <?php if(isset($post['hashtag3'])) echo $post['hashtag3']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Buttons like and comments -->
                        <div class="row mt-2">
                            <div class="col d-flex justify-content-end align-items-center mb-2">
                                <button class="comment btn btn-success border-dark me-2" type="button" data-bs-toggle="modal" data-bs-target="#comments-banner" data-postid=<?php echo $post["idPost"]; ?>>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat" viewBox="0 1 16 16">
                                        <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </button>
                                <button class="like btn btn-success border-dark me-2" type="button" data-postid=<?php echo $post["idPost"]; ?>>
                                    <?php
                                        $isLiked = $dbh->getLikesByUserAndPostId($_SESSION["username"], $post["idPost"]);
                                        $likedClass = $isLiked ? 'liked' : '';
                                    ?>
                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="1 1 16 16">
                                        <image xlink:href="./img/<?php echo $likedClass == 'liked' ? 'symbol_liked.png' : 'symbol.png'; ?>" height="17.5" width="17.5"/>
                                    </svg>
                                </button>
                                <p class="likenumber mb-0" data-postid="<?php echo $post["idPost"]; ?>" id="like-<?php echo $post["idPost"]; ?>"></p>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
                <?php require_once("./components/comments-banner.php"); ?>
            <?php else: ?>
                <p class="text-center mt-5">Non hai ancora aggiunto post... crea subito il primo!</p>
            <?php endif; ?>
        </div>
    </section>
</div>