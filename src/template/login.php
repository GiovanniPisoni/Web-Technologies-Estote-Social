<form action="#" method="POST" id="login-Form" class="position-relative">
    <div class="d-flex justify-content-center">
        <img src="img/LoginPhoto.png" alt="Login photo" width="275"/>
    </div>
    <div class="d-flex justify-content-center mt-3"> 
        <label for="username" class="me-2">Username</label>
        <input type="text" name="username" id="username" placeholder="Username" required>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <label for="password" class="me-2">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
    </div>
    <div class="d-flex justify-content-center">
        <label for="login" hidden>Login</label>
        <input class="btn btn-success w-40 mt-3 mb-2" type="submit" name="login" id="login" value="Login">
    </div>
    <p class="text-center">Non Hai ancora un account? Beh... <a href="register.php" class="text-success">REGISTRATI</a>!</p>     
</form>