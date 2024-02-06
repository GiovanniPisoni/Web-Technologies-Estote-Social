<div class="modal fade" id="modify-profile-banner" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modify-profile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title h5" id="modify-profile">Modifica il tuo profilo</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi" onclick="location.reload()"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="modifyProfileForm" enctype="multipart/form-data">
                    <div class="mx-4 mb-2">
                        <label for="nameModify" hidden>Nome</label>
                        <input class="form-control" type="text" name="nameModify" id="nameModify" placeholder="Nome" autocomplete="given-name">
                    </div>
                    <div class="mx-4 mb-2">
                        <label for="surnameModify" hidden>Cognome</label>
                        <input class="form-control" type="text" name="surnameModify" id="surnameModify" placeholder="Cognome">
                    </div>
                    <div class="mx-4 mb-2">
                        <label for="birthdayModify" hidden>Data di nascita</label>
                        <input class="form-control" type="date" name="birthdayModify" id="birthdayModify">
                    </div>
                    <div class="mx-4 mb-2">
                        <label for="groupModify" hidden>Gruppo di appartenenza</label>
                        <input class="form-control" type="text" name="groupModify" id="groupModify" placeholder="Gruppo di appartenenza">
                    </div>
                    <div class="mx-4 mb-2">
                        <label for="bioModify" hidden>Bio</label>
                        <textarea class="form-control no-resize overflow-y-auto" name="bioModify" id="bioModify" placeholder="Bio-Raccontaci un po' di te" rows="3"></textarea>
                    </div>
                    <div class="mx-4 mb-2">
                        <label for="emailModify" hidden>Email</label>
                        <input class="form-control" type="text" name="emailModify" id="emailModify" placeholder="Email" autocomplete="email">
                    </div>
                    <div class="mx-4 mb-2">
                        <label for="totemModify" hidden>Totem</label>
                        <input class="form-control" type="text" name="totemModify" id="totemModify" placeholder="Totem">
                    </div>
                    <div class="mx-4 mb-2">
                        <label for="imageProfileModify">Immagine Profilo</label>
                        <input class="form-control mt-1" type="file" name="imageProfileModify" id="imageProfileModify" accept="image/*">
                    </div>
                    <div class="mx-4 mb-2">
                            <label for="imgFazzolettoneModify">Fazzolettone</label>
                            <input class="form-control ms-1" aria-label="Immagine del post" type="file" name="imgFazzolettoneModify" id="imgFazzolettoneModify" accept="image/*">
                    </div>
                    <div class="mx-4 mb-2">
                            <label for="imgSpecialitaModify">Specialità</label>
                            <input class="form-control ms-1" aria-label="Immagine del post" type="file" name="imgSpecialitaModify" id="imgSpecialitaModify" accept="image/*">
                    </div>
                    <footer>
                        <div class="text-body-secondary text-start">
                            <p class="small text-center" id="imgdimension">Max image dimension: 10Mb</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <label for="delete" hidden>Annulla modifiche</label>
                            <input class="btn btn-danger w-100 mt-3 mb-1" type="submit" name="delete" id="delete" value="Annulla modifiche">
                        </div>
                        <div class="d-flex justify-content-center">
                            <label for="save" hidden>Salva ed esci</label>
                            <input class="btn btn-success w-100 mb-3" type="submit" name="save" id="save" value="Salva ed esci">
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>