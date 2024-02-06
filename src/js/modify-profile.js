document.addEventListener("DOMContentLoaded", () => {
    const username = document.getElementById("modifyIcon").getAttribute("data-username");

    document.getElementById("modifyIcon").addEventListener("click", event => {
        const formData = new FormData();
        formData.append('username', username);

        axios.post('./api/profile-api.php', formData).then(response => {
            if(response != null) {
                document.getElementById("nameModify").value = response.data[0].nome;
                document.getElementById("surnameModify").value = response.data[0].cognome;
                document.getElementById("emailModify").value = response.data[0].mail;
                document.getElementById("bioModify").value = response.data[0].bio;
                document.getElementById("totemModify").value = response.data[0].totem;
                document.getElementById("groupModify").value = response.data[0].gruppoappartenenza;
                document.getElementById("birthdayModify").value = response.data[0].datadiNascita;
            }
        });
    });

    document.getElementById("save").addEventListener("click", async (event) => {
        event.preventDefault();
        const formData = new FormData();

        formData.append('username', username);
        formData.append('name', document.getElementById("nameModify").value);
        formData.append('surname', document.getElementById("surnameModify").value);
        formData.append('email', document.getElementById("emailModify").value);
        formData.append('bio', document.getElementById("bioModify").value);
        formData.append('totem', document.getElementById("totemModify").value);
        formData.append('group', document.getElementById("groupModify").value);
        formData.append('birthday', document.getElementById("birthdayModify").value);

        if (document.getElementById("imageProfileModify").files[0] != null) {
            const formDataImage = new FormData();
            formDataImage.append("image", document.getElementById("imageProfileModify").files[0]);
            const responseUpload = await axios.post('./api/image-api.php', formDataImage); // Aggiungi await qui
            if (!responseUpload.data["uploadEseguito"]) {
                console.log(responseUpload.data)
                console.log(responseUpload.data["erroreUpload"]);
            } else {
                formData.append('immagineProfilo', responseUpload.data["fileName"]);
            }
        }
        if(document.getElementById("imgFazzolettoneModify").files[0] != null) {
            const formDataFazzolettone = new FormData();
            formDataFazzolettone.append("image", document.getElementById("imgFazzolettoneModify").files[0]);
            const responseUpload = await axios.post('./api/image-api.php', formDataFazzolettone); // Aggiungi await qui
            if (!responseUpload.data["uploadEseguito"]) {
                console.log(responseUpload.data)
                console.log(responseUpload.data["erroreUpload"]);
            } else {
                formData.append('imgFazzolettone', responseUpload.data["fileName"]);
            }
        }
        if(document.getElementById("imgSpecialitaModify").files[0] != null) {
            const formDataSpecialita = new FormData();
            formDataSpecialita.append("image", document.getElementById("imgSpecialitaModify").files[0]);
            const responseUpload = await axios.post('./api/image-api.php', formDataSpecialita); // Aggiungi await qui
            if (!responseUpload.data["uploadEseguito"]) {
                console.log(responseUpload.data)
                console.log(responseUpload.data["erroreUpload"]);
            } else {
                formData.append('imgSpecialita', responseUpload.data["fileName"]);
            }
        }

            axios.post('./api/modifyprofile-api.php', formData).then(response => {
                location.reload();
                alert("Profilo modificato con successo!");
            });
    });

    document.getElementById("delete").addEventListener("click", (event) => {
        event.preventDefault();
        
        document.getElementById("nameModify").value = null; 
        document.getElementById("surnameModify").value = null; 
        document.getElementById("emailModify").value = null; 
        document.getElementById("bioModify").value = null; 
        document.getElementById("totemModify").value = null; 
        document.getElementById("groupModify").value = null; 
        document.getElementById("birthdayModify").value = null;
        document.getElementById("imageProfileModify").value = null;
        document.getElementById("imgFazzolettoneModify").value = null;
        document.getElementById("imgSpecialitaModify").value = null;
    });
});