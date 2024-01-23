<script src="./js/addPost.js" defer></script>

<div class="m-2 py-2 slider">
    <section class="bg-light border border-dark my-4 px-4 pt-3 pb-1 rounded">
        <header>
            <div id="topic" class="col-12 px-2 topic">
                <h2 id="title"><?php 
                        if(isset($templateParams[0])){
                            echo $templateParams[0]["nome"];
                        }else{
                            echo "";
                        }
                    ?>
                </h2>
            </div>
        </header>
        <!-- Divider -->
        <div class="d-flex justify-content-center col-12">
            <hr class="#000 w-100"/>
        </div>
        <form id="addPostForm" action="#" method="post">
            <!-- Post image -->
            <div id="addImage" class="d-flex justify-content-center">
                <span id="cameraIcon" class="fa fa-camera fa-5x" aria-hidden="true"></span>
                <img id="img" class="img-fluid" alt="Post image">
            </div>
            <div class="d-flex justify-content-center m-2">
                <button type="button" id="removeImgButton" class="btn btn-primary">Rimuovi immagine</button>
            </div> 
            <div class="fil d-flex justify-content-center">
                <input aria-label="immagine del post" type="file" id="photoElem" accept="image/*"/>
            </div>

            <!-- Divider -->
            <div class="d-flex justify-content-center col-12">
                <hr class="#000 w-100"/>
            </div>

            <!-- Add text -->
            <textarea aria-label="testo del post" id="textElem" class="w-100 rounded" rows="5" placeholder="Scrivi qui il testo!" required></textarea>

            <!-- Divider -->
            <div class="d-flex justify-content-center col-12">
                <hr class="#000 w-100"/>
            </div>

            <!-- Add hashtags -->
            <div class="d-flex justify-content-center">
                <input aria-label="hashtag del post" id="hashtagElem1" type="text" class="form-control w-50" placeholder="Aggiungi un hashtag">
                <input aria-label="hashtag del post" id="hashtagElem2" type="text" class="form-control w-50" placeholder="Aggiungi un hashtag">
                <input aria-label="hashtag del post" id="hashtagElem3" type="text" class="form-control w-50" placeholder="Aggiungi un hashtag">
            </div>

            <!-- Divider -->
            <div class="d-flex justify-content-center col-12">
                <hr class="#000 w-100"/>
            </div>
            
            <!-- Send post -->
            <footer class="my-1">
                <div class="d-flex justify-content-center">
                    <button type="submit" id="sendPostButton" class="btn btn-primary">
                        Pubblica
                    </button>
                </div>   
            </footer>
        </form>
        
    </section>
</div>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>EstoteSocial: <?php echo $templateParams["title"]; ?></title>
    <link rel="icon" type="image/x-icon" href="img/miniLogo.png">
    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script defer src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</head>
<body class="d-flex justify-content-center py-4 bg-success-subtle">
    <div class="border border-dark-subtle rounded-4 mw-75 p-3 m-2 text-center">
        <header>
            <img src="img/Logo.png" alt="EstoteSocial icon" width="250"/>
            <h1 class="h4 my-0 mb-3 fst-italic"><?php echo $templateParams["title"]; ?></h1>
        </header>
        <main>
            <div class="m-2 py-2 slider">
                <section class="bg-light border border-dark my-4 px-4 pt-3 pb-1 rounded">
                    <header>
                        <div id="topic" class="col-12 px-2 topic">
                            <h2 id="title"><?php 
                                    if(isset($templateParams[0])){
                                        echo $templateParams[0]["nome"];
                                    }else{
                                        echo "";
                                    }
                                ?>
                            </h2>
                        </div>
                    </header>
                    <!-- Divider -->
                    <div class="d-flex justify-content-center col-12">
                        <hr class="#000 w-100"/>
                    </div>
                    <form id="addPostForm" action="#" method="post">
                        <!-- Post image -->
                        <div id="addImage" class="d-flex justify-content-center">
                            <span id="cameraIcon" class="fa fa-camera fa-5x" aria-hidden="true"></span>
                            <img id="img" class="img-fluid" alt="Post image">
                        </div>
                        <div class="d-flex justify-content-center m-2">
                            <button type="button" id="removeImgButton" class="btn btn-primary">Rimuovi immagine</button>
                        </div> 
                        <div class="fil d-flex justify-content-center">
                            <input aria-label="immagine del post" type="file" id="photoElem" accept="image/*"/>
                        </div>

                        <!-- Divider -->
                        <div class="d-flex justify-content-center col-12">
                            <hr class="#000 w-100"/>
                        </div>

                        <!-- Add text -->
                        <textarea aria-label="testo del post" id="textElem" class="w-100 rounded" rows="5" placeholder="Scrivi qui il testo!" required></textarea>

                       
                        
                        <!-- Divider -->
                        <div class="d-flex justify-content-center col-12">
                            <hr class="#000 w-100"/>
                        </div>

                        <!-- Send post -->
                        <footer class="my-1">
                            <div class="d-flex justify-content-center">
                                <button type="submit" id="sendPostButton" class="btn btn-primary">
                                    Pubblica
                                </button>
                            </div>   
                        </footer>
                    </form>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
