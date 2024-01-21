document.querySelector('#login-Form').addEventListener('submit', function (event) {
    event.preventDefault();
    login();
    event.target.reset();
});

/*function login() {
    const formDB = new FormData();
    formDB.append('username', document.querySelector('#username').value);
    formDB.append('password', document.querySelector('#password').value);
    axios.post('./api/login-api.php', formDB).then(response => {
        if (response.data["login_result"]) {
            console.log("Il file JavaScript funziona");
            document.querySelector('#login-Form > p').innerText = "Login effettuato con successo!"
            setTimeout(() => document.location.href = "", 2000);
        } else {
            document.querySelector('#login-Form > p').innerText = "Risposta dal server NON valida.";
        }
    });
}*/

/*function login() {
    const formDB = new FormData();
    formDB.append('username', document.querySelector('#username').value);
    formDB.append('password', document.querySelector('#password').value);

    axios.post('../src/api/login-api.php', formDB)
        .then(response => {
            console.log("Risposta dal server:", response.data);

            if (response.data && response.data.login_result) {
                document.querySelector('#login-Form > p').innerText = "Login effettuato con successo!";
                setTimeout(() => document.location.href = "", 2000);
            } else if (response.data && response.data.erroreLogin) {
                document.querySelector('#login-Form > p').innerText = response.data.erroreLogin;
            } else {
                document.querySelector('#login-Form > p').innerText = "";
            }
        })
        .catch(error => {
            console.error("Errore nella richiesta:", error);
            document.querySelector('#login-Form > p').innerText = "Errore nella richiesta al server.";
        });
}*/

function login(username, password) {
    const formData = new FormData();
  
    formData.append('username', username);
    formData.append('password', password);
  
    axios.post('./api/login-api.php', formData).then(response => {
        if (response.data["login-result"]) {
          window.location.href = "../php/showhomepage.php";
        } else {
          document.getElementById("login-error").innerText = response.data["login-error"];
        }
    });
  }