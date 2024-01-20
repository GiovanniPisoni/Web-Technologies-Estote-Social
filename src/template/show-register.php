<form action="#" method="POST" id="register-Form">
    <div class="mx-4 mb-2">
        <label for="name" hidden>Nome</label>
        <input class="form-control" type="text" name="name" id="name" placeholder="Nome">
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
        <label for="email" hidden>Email</label>
        <input class="form-control" type="email" name="email" id="email" placeholder="Email*" required>
    </div>
    <div class="mx-4 mb-2">
        <label for="username" hidden>Username</label>
        <input class="form-control" type="text" name="username" id="username" placeholder="Username*" required>
    </div>
    <div class="mx-4 mb-2">
        <label for="password" hidden>Password</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Password*" required>
    </div>
    <div class="mx-4 mb-2">
        <label for="password_confirm" hidden>Conferma Password</label>
        <input class="form-control" type="password" name="password_confirm" id="password_confirm" placeholder="Conferma Password*" required>
    </div>
    <div class="mx-4 mb-2">
        <input class="form-control mt-1" type="file" name="image" id="image" accept="image/*" required style="display: none;">
        <label for="image" class="btn btn-success mt-1">Seleziona Immagine Profilo*</label>
    </div>
    <div>
        <label for="register" hidden>Registrati</label>
        <input class="btn btn-success w-40 mt-3 mb-2" type="submit" name="register" id="register" value="Registrati">
        <p class="small">Sei già registrato? Allora <a href="index.php" class="text-dark">ACCEDI</a>!</p>
    </div>
    <div class="text-body-secondary text-start">
        <label for="clarification" class="small">*Campi obbligatori</label>
    </div>