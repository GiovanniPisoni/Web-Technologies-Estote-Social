<?php if(!empty($templateParams["posts"])): ?>
    <?php foreach ($templateParams["posts"] as $post): ?>
        <section class="bg-light border border-dark my-4 px-4 pt-3 pb-1 rounded">
            <!-- Profile image -->
            <div class="row">
                <div id="<?php echo $post['IDPost'] ?>" class="col text-start">
                    <a href="profile-api.php?id=<?php echo $post['Username_seguito'] ?>" class="text-decoration-none">
                        <img src="./img/<?php echo $post['ImmagineProfilo'] ?>" alt="Profile image" class="rounded-circle" height="40" width="40">
                    </a>
                    <a href="profile.php?id=<?php echo $post['Username_seguito'] ?>" class="username usernameStyle" id="<?php echo $post["Username_seguito"]; ?>">@<?php echo $post["Username_seguito"]; ?></a>
                </div>
            </div>
            <div class="row mt-2">
                <!-- Post image -->
                <?php if(isset($post['Immagine'])): ?>
                    <div class="col text-center">
                        <img src="./img/<?php echo $post['Immagine'] ?>" alt="Post image" class="img-fluid rounded max-size-image">
                    </div>
                <?php endif; ?>
            </div>
            <div class="row mt-2">
                <!-- Post data -->
                <div class="col text-start">
                    <p class="mb-0"><?php echo $post["Data"]; ?></p>
                </div>
                <!-- Comment button -->
                <div class="col text-end">
                    <button class="comment" type="button" data-bs-toogle="modal" data-bs-target="#comments-modal" data-postid=<?php echo $post["IDPost"]; ?>>
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </button>
                </div>
                <!-- Like button -->
                <div class="col text-end">
                    <button class="like" type="button" data-postid=<?php echo $post["IDPost"]; ?>>
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                            <image href="./img/symbol.png" height="20" width="20"/>
                        </svg>
                    </button>
                </div>
                <div class="col text-end">
                    <a href="#" class="like" data-postid="<?php echo $post["IDPost"]; ?>" id="like-<?php echo $post["IDPost"]; ?>"></a>
                </div>
                    <script>
                        window.addEventListener('DOMContentLoaded', (event) => {
                            var postId = document.querySelector('#like-<?php echo $post["IDPost"]; ?>').dataset.postid;
                            fetch('./api/likenumber-api.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ id: postId }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                document.querySelector('#like-' + postId).textContent = data.likes;
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                        });
                    </script>
            </div>
            <div class="row mt-2">
                <!-- Post text -->
                <div class="col text-start">
                    <p class="mb-0"><?php echo $post["Testo"]; ?></p>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">Non ci sono post da mostrare, per vederli inizia a seguire i tuoi amici</p>
<?php endif; ?>