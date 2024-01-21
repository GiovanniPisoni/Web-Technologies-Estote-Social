document.querySelector('#register-Form').addEventListener('submit', function (event) {
    event.preventDefault();
    register();
    event.target.reset();
});

function register() {

    const formDB = new FormData();
    //Optional fields
    formDB.append('name', document.querySelector('#name').value);
    formDB.append('surname', document.querySelector('#surname').value);
    formDB.append('birthday', document.querySelector('#birthday').value);
    formDB.append('group', document.querySelector('#group').value);
    //Required fields
    formDB.append('email', document.querySelector('#email').value);
    formDB.append('username', document.querySelector('#username').value);
    formDB.append('password', document.querySelector('#password').value); 
    formDB.append('password_confirm', document.querySelector('#password_confirm').value);
    
    const formDBImage = new FormData();
    formDBImage.append('image', document.querySelector('#image').files[0]);

    axios.post('./api/immagine-api.php', formDBImage).then(responseImage => {
        if (!responseImage.data["uploadEseguito"]) {
            document.getElementById("register-error").innerText = responseImage.data["erroreUpload"];
        } else {
            formDB.append('image', responseImage.data["fileName"]);
            axios.post('./api/registrazione-api.php', formDB).then(responseSignIn => {
                console.log(responseSignIn);
                if (responseSignIn.data["signin-result"]) {
                    window.location.href = '../php/login.php';
                } else {
                    document.getElementById("register-error").innerText = responseSignIn.data["erroreSignin"];
                }
            });
        }
    });
}