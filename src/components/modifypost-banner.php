<div class="modal fade" id="modifypost-banner" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Modifica post" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="addPost">Modifica post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi" onclick="location.reload()"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="modifyPostForm" enctype="multipart/form-data">
                    <div class="d-flex justify-content-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" id="cameraIcon" width="45" height="45" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                        </svg>
                        <img class="size-container img-fluid mx-auto" id="container" alt="Post image">
                    </div>
                    <div class="fil d-flex justify-content-center mb-3">
                        <label for="imgpost" hidden>Immagine</label>
                        <input aria-label="Immagine del post" type="file" id="imgpost" accept="image/*"> 
                        <button type="button" id="removeImgButton" class="mr-1 btn btn-success">Rimuovi immagine</button>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <label for="description" hidden>Descrizione</label>
                        <textarea class="form-control no-resize overflow-y-auto" id="description" name="description" placeholder="Aggiungi una descrizione" rows="3" required></textarea>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <label for="hashtag1" hidden>Hashtag 1</label>
                        <input class="form-control" type="text" id="hashtag1" name="hashtag1" placeholder="Aggiungi un hashtag per facilitare la ricerca agli altri utenti">
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <label for="hashtag2" hidden>Hashtag 2</label>
                        <input class="form-control" type="text" id="hashtag2" name="hashtag2" placeholder="Aggiungi un hashtag per facilitare la ricerca agli altri utenti">
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <label for="hashtag3" hidden>Hashtag 3</label>
                        <input class="form-control" type="text" id="hashtag3" name="hashtag3" placeholder="Aggiungi un hashtag per facilitare la ricerca agli altri utenti">
                    </div>
                    <div class="text-body-secondary text-start">
                         <p class="small" name="clarification" id="clarification">Max image dimension: 10Mb</p>
                    </div>
                    <footer class="my-1">
                        <div class="d-flex justify-content-center">
                            <button type="submit" id="sendPostButton" class="w-100 btn btn-success">Modifica</button>
                        </div>   
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>