document.addEventListener("DOMContentLoaded", () => {
    const username = document.getElementById("modifyIcon").getAttribute("data-username");

    document.getElementById("modifyIcon").addEventListener("click", event => {
        const formData = new FormData();
        formData.append('username', username);
        
        axios.post('./api/profile-api.php', formData).then(response => {
            if(response != null) {
                document.getElementById("name").value = response.data[0].nome;
                document.getElementById("surname").value = response.data[0].cognome;
                document.getElementById("email").value = response.data[0].mail;
                document.getElementById("bio").value = response.data[0].bio;
                document.getElementById("totem").value = response.data[0].totem;
                document.getElementById("group").value = response.data[0].gruppoappartenenza;
                document.getElementById("birthday").value = response.data[0].datadiNascita;
            }
        });
    });

    document.getElementById("modifyProfileForm").addEventListener("submit", (event) => {
        event.preventDefault();
        const formData = new FormData();

        formData.append('username', username);
        formData.append('name', document.getElementById("name").value);
        formData.append('surname', document.getElementById("surname").value);
        formData.append('email', document.getElementById("email").value);
        formData.append('bio', document.getElementById("bio").value);
        formData.append('totem', document.getElementById("totem").value);
        formData.append('group', document.getElementById("group").value);
        formData.append('birthday', document.getElementById("birthday").value);

        if (document.getElementById("imageProfile").files[0]) {
            const formDataImage = new FormData();
            formDataImage.append("image", document.getElementById("imageProfile").files[0]);
            axios.post('./api/image-api.php', formDataImage).then(responseUpload => {
                if (!responseUpload.data["uploadEseguito"]) {
                    console.log(responseUpload.data)
                    console.log(responseUpload.data["erroreUpload"]);
                } else {
                    formData.append('immagineProfilo', responseUpload.data["fileName"]);
                }
            });
        }
        if(document.getElementById("imgFazzolettone").files[0]) {
            const formDataFazzolettone = new FormData();
            formDataFazzolettone.append("image", document.getElementById("imgFazzolettone").files[0]);
            axios.post('./api/image-api.php', formDataFazzolettone).then(responseUpload => {
                if (!responseUpload.data["uploadEseguito"]) {
                    console.log(responseUpload.data)
                    console.log(responseUpload.data["erroreUpload"]);
                } else {
                    formData.append('imgFazzolettone', responseUpload.data["fileName"]);
                }
            });
        }
        if(document.getElementById("imgSpecialita").files[0]) {
            const formDataSpecialita = new FormData();
            formDataSpecialita.append("image", document.getElementById("imgSpecialita").files[0]);
            axios.post('./api/image-api.php', formDataSpecialita).then(responseUpload => {
                if (!responseUpload.data["uploadEseguito"]) {
                    console.log(responseUpload.data)
                    console.log(responseUpload.data["erroreUpload"]);
                } else {
                    formData.append('imgSpecialita', responseUpload.data["fileName"]);
                }
            });
        }

        axios.post('./api/modifyprofile-api.php', formData).then(response => {
            console.log(response.data);
            alert("Profilo modificato con successo!");
            location.reload();
        });
    });
});