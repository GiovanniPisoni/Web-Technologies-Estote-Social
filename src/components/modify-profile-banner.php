<div class="modal fade" id="modify-profile-banner" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Aggiungi post" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="modify-profile">Modifica il tuo profilo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi" onclick="location.reload()"></button>
            </div>
            <div class="modal-body">
                <div class="mx-4 mb-2">
                    <label for="name" hidden>Nome</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Nome" autocomplete="given-name">
                </div>
                <div class="mx-4 mb-2">
                    <label for="surname" hidden>Cognome</label>
                    <input class="form-control" type="text" name="surname" id="surname" placeholder="Cognome">
                </div>
                <div class="mx-4 mb-2">
                    <label for="birthday" hidden>Data di nascita</label>
                    <input class="form-control" type="date" name="birthday" id="birthday" placeholder="Data di nascita">
                </div>
                <div class="mx-4 mb-2">
                    <label for="group" hidden>Gruppo di appartenenza</label>
                    <input class="form-control" type="group" name="group" id="group" placeholder="Gruppo di appartenenza">
                </div>
                <div class="mx-4 mb-2">
                    <label for="bio" hidden>Bio</label>
                    <textarea class="form-control no-resize overflow-y-auto" type="bio" name="bio" id="bio" placeholder="Bio-Raccontaci un po' di te" rows="3" required></textarea>
                </div>
                <div class="mx-4 mb-2">
                    <label for="email" hidden>Email</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="Email" autocomplete="email" required>
                </div>
                <div class="mx-4 mb-2">
                    <label for="image">Immagine Profilo</label>
                    <input class="form-control mt-1" type="file" name="image" id="image" accept="image/*" required>
                </div>
                <div class="text-body-secondary text-start">
                    <p class="small text-center" name="imgdimension" id="imgdimension">Max image dimension: 10Mb</p>
                </div>
                <div class="d-flex justify-content-center">
                    <label for="register" hidden>Annulla modifiche</label>
                    <input class="btn btn-danger w-100 mt-3 mb-1" type="submit" name="delete" id="delete" value="Annulla modifiche">
                </div>
                <div class="d-flex justify-content-center">
                    <label for="register" hidden>Salva ed esci</label>
                    <input class="btn btn-success w-100 mb-3" type="submit" name="save" id="save" value="Salva ed esci">
                </div>
            </div>
        </div>
    </div>
</div>