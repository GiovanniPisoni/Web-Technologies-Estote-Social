<head>
    <script src="./js/login.js" defer></script>
</head>
<form action="#" method="POST" id="login-Form">
    <div class="d-flex justify-content-center">
        <img src="img/LoginPhoto.png" alt="Login photo" width="275" class="rounded-4"/>
    </div>
    <div class="d-flex justify-content-center mt-3"> 
        <label for="username" hidden>Username</label>
        <input class="form-control ms-4 me-4" type="text" name="username" id="username" placeholder="Username" autocomplete="username" required>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <label for="password" hidden>Password</label>
        <input class="form-control ms-4 me-4" type="password" name="password" id="password" placeholder="Password" required>
    </div>
    <div class="d-flex justify-content-center">
        <label for="login" hidden>Login</label>
        <input class="btn btn-success w-40 mt-3 mb-2" type="submit" name="login" id="login" value="Login">
    </div>
    <p class="text-center small">Non hai ancora un account? Beh... <a href="./register.php" class="text-black">REGISTRATI</a>!</p>
    <p id="login-error" class="text-center fw-bold text-danger-emphasis"></p>
</form>