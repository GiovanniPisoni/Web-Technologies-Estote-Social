<?php if(!empty($templateParams["posts"])): ?>
    <?php foreach ($templateParams["posts"] as $post): ?>
        <article class="bg-light border border-dark my-4 px-4 pt-3 pb-1 rounded">
            <!-- Profile image -->
            <div class="row">
                <div class="col text-start" id="<?php echo $post['IDPost'] ?>">
                    <a href="profile-api.php?id=<?php echo $post['Username_seguito'] ?>" class="text-decoration-none">
                        <img src="./img/<?php echo $post['ImmagineProfilo'] ?>" alt="Profile image" class="rounded-circle" height="40" width="40">
                    </a>
                    <!-- Profile name -->
                    <a href="profile.php?id=<?php echo $post['Username_seguito'] ?>" class="username usernameStyle" id="<?php echo $post["Username_seguito"]; ?>">@<?php echo $post["Username_seguito"]; ?></a>
                    <!-- Post date -->
                    <p class="ms-1 mt-1 mb-0 smaller-font">
                        <?php 
                            $date = new DateTime($post["Data"]);
                            echo $date->format('d-m-Y');
                        ?>
                    </p>
                </div>
            </div>
            <!-- Post image -->
            <?php if(isset($post['Immagine'])): ?>
                <img src="./img/<?php echo $post['Immagine'] ?>" alt="Post image" class="img-fluid rounded max-size-image">
            <?php endif; ?>
            <!-- Post text -->
            <p class="mt-1 mb-0 fst-italic"><?php echo $post["Testo"]; ?></p>
            <div class="row mt-2">
                <!-- Buttons -->
                <div class="col text-end mb-2">
                    <button class="comment btn btn-success border-dark me-2" type="button" data-bs-toggle="modal" data-bs-target="#comments-banner" data-postid=<?php echo $post["IDPost"]; ?>>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat" viewBox="0 1 16 16">
                            <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                        </svg>
                    </button>
                    <button class="btn btn-success border-dark" type="button" data-likeid="<?php echo $post["IDPost"]; ?>" data-postid=<?php echo $post["IDPost"]; ?>>
                        <?php
                            $isLiked = $dbh->getLikesByUserAndPostId($_SESSION["username"], $post["IDPost"]);
                            $likedClass = $isLiked ? 'liked' : '';
                        ?>
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="1 1 16 16">
                            <image xlink:href="./img/<?php echo $likedClass == 'liked' ? 'symbol_liked.png' : 'symbol.png'; ?>" height="17.5" width="17.5"/>
                        </svg>
                    </button>
                    <a href="#" class="likenumber" data-postid="<?php echo $post["IDPost"]; ?>" id="like-<?php echo $post["IDPost"]; ?>"></a>
                    <!-- <script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        // Seleziona tutti gli elementi con la classe 'likenumber'
                        var likeElements = document.querySelectorAll('.likenumber');

                        // Per ogni elemento, invia una richiesta al server per ottenere il numero di "likes"
                        likeElements.forEach((element) => {
                            var postId = element.dataset.postid;

                            fetch('./api/likenumber-api.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ postId: postId }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Stampa il numero di "likes" nell'elemento
                                element.textContent = data.likes;
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                        });
                    });
                    </script> -->
                </div>
            </div>
        </article>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center mt-5">Non ci sono post.. inizia a seguire i tuoi amici per vederli!!</p>
<?php endif; ?>