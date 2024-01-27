<?php if(!empty($templateParams["posts"])): ?>
    <section class="bg-light border border-dark my-4 px-4 pt-3 pb-1 rounded">
        <!-- Profile image -->
        <div class="row">
            <div id="post<?php echo $post['id'] ?>" class="col text-start">
                <a href="profile.php?id=<?php echo $post['username'] ?>">
                    <img src="./img/<?php echo $post['immagineProfilo'] ?>" alt="Profile image" class="rounded-circle" height="30" width="30">
                </a>
            </div>
            <!-- Username -->
            <div class="col text-start">
                <a href="profile.php?id=<?php echo $post['username'] ?>" class="username" id="<?php echo $post["username"]; ?>">@<?php echo $post["username"]; ?></a>
            </div>
        </div>
        <div class="row mt-2">
            <!-- Post image -->
            <?php if(isset($post['immagine'])): ?>
                <div class="col text-center">
                    <img src="./img/<?php echo $post['immagine'] ?>" alt="Post image" class="img-fluid rounded">
                </div>
            <?php endif; ?>
        </div>
        <div class="row mt-2">
            <?php if($templateParams["isAuth"]): ?>
                <!-- Post data -->
                <div class="col text-start">
                    <p class="mb-0"><?php echo $post["data"]; ?></p>
                </div>
                <!-- Comment button -->
                <div class="col text-end">
                    <button class="comment" type="button" data-bs-toogle="modal" data-bs-target="#comments-modal" data-postid=<?php echo $post["idPost"]; ?>>
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </button>
                </div>
                <!-- Like button -->
                <div class="col text-end">
                    <button class="like" type="button" data-postid=<?php echo $post["idPost"]; ?>>
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                            <image href="./img/symbol.png" height="20" width="20"/>
                        </svg>
                    </button>
                </div>
                <div class="col text-end">
                    <p class="like" data-postid="<?php echo $post["idPost"]; ?>"><?php echo $post["likes"]; ?></p>
                </div>
            <?php endif ?>
        </div>
        <div class="row mt-2">
            <!-- Post text -->
            <div class="col text-start">
                <p class="mb-0"><?php echo $post["description"]; ?></p>
            </div>
        </div>
    </section>
<?php else: ?>
    <p class="text-center">Non ci sono post da mostrare, per vederli inizia a seguire i tuoi amici ;)</p>
<?php endif; ?>