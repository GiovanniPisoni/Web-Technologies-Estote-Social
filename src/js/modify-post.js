document.querySelector('#postContainer').addEventListener('click', function(event) {
    const linkElement = event.target.closest('a');
    if (linkElement) {
        const idPost = linkElement.getAttribute('data-postid');
        const noImgLabel = document.getElementById("cameraIconModify");
        const postImg = document.getElementById('imgpostModify');
        const imgContainer = document.getElementById("containerModify");
        const removeImgButton = document.getElementById("removeImgButtonModify");
        let oldImageName = "";
        let newImgName = "";
        let currImgName = "";
        let imgChanged = false;
        let removeOldImg = false;
        let username;

        const formData = new FormData();
        formData.append('idPost', idPost);

        axios.post('./api/getpost-api.php', formData).then(response => {
            if(response != null) {
                if(response.data[0].immagine != null) {
                    console.log("Immagine presente nel post");
                    noImgLabel.style.display = "none";
                    imgContainer.style.display = "block";
                    removeImgButton.style.display = "block";
                    imgContainer.setAttribute("src", "./img/" + response.data[0].immagine);
                    oldImageName = response.data[0].immagine;
                    console.log("Settato oldimage name:" + oldImageName);
                    currImgName = response.data[0].immagine;
                    console.log("Settato currimage name:" + currImgName);
                } else {
                    console.log("Immagine non presente nel post");
                    imgContainer.style.display = "none";
                    removeImgButton.style.display = "none";
                    noImgLabel.style.display = "block";
                }
                username = response.data[0].username;
                document.getElementById("descriptionModify").value = response.data[0].testo;
                document.getElementById("hashtag1Modify").value = response.data[0].hashtag1;
                document.getElementById("hashtag2Modify").value = response.data[0].hashtag2;
                document.getElementById("hashtag3Modify").value = response.data[0].hashtag3;
            }
        });

        removeImgButton.addEventListener("click", event => {
            if(oldImageName != "") {
                removeOldImg = true;
                console.log("Settato remove old image perchè c'era un'immagine vecchia: " + removeOldImg);
            }
            console.log("Non c'era un'immagine vecchia, non cambio remove old image: " + removeOldImg)
            currImgName = "";
            console.log("Settato currimage name vuoto poichè rimuovo l'immagine: " + currImgName);
            imgContainer.style.display = "none";
            removeImgButton.style.display = "none";
            noImgLabel.style.display = "block";
            postImg.value = "";
        });

        postImg.addEventListener("change", event => {
            if(postImg.files[0] == null) {
                imgContainer.style.display = "none";
                removeImgButton.style.display = "none";
                noImgLabel.style.display = "block";
            } else {
                imgContainer.style.display = "block";
                removeImgButton.style.display = "block";
                noImgLabel.style.display = "none";
                let output = document.getElementById('containerModify');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src)
                }
                currImgName = postImg.files[0].name;
                console.log("Immagine cambiata, nuova immagine caricata: " + currImgName);
                if(oldImageName != "") {
                    removeOldImg = true;
                    console.log("Settato remove old image perchè c'era un'immagine vecchia (" + oldImageName + ") a: "+ removeOldImg);
                }
            }
        });

        document.getElementById("modifyPostForm").addEventListener("submit", (event) => {
            event.preventDefault()
            const formData = new FormData();

            formData.append('idPost', idPost);

            if(removeOldImg) {
                console.log("Elimino l'immagine vecchia poichè era a true remove: " + oldImageName);
                axios.post('./api/deletepostimage-api.php', formData);
                //delete post image from file system
                const formDataDelete = new FormData()
                formDataDelete.append("removeimage", oldImageName)
                axios.post('./api/deleteimage-api.php', formDataDelete).then(response => {
                    if (!response.data["eliminazione"]) {
                        console.log(response.data);
                    }
                });
            }
            formData.append('testo', document.getElementById("descriptionModify").value);
            formData.append('hashtag1', document.getElementById("hashtag1Modify").value);
            formData.append('hashtag2', document.getElementById("hashtag2Modify").value);
            formData.append('hashtag3', document.getElementById("hashtag3Modify").value);

            if(postImg.files[0] != null) {
                const formDataImage = new FormData();
                let newimg = postImg.files[0];
                formDataImage.append('image', newimg);
                console.log("Carico l'immagine nuova: " + currImgName);
                console.log(postImg.files[0]);
                console.log(formDataImage.get('image'));

                axios.post('./api/image-api.php', formDataImage).then(responseUpload => {
                    if (!responseUpload.data["uploadEseguito"]) {
                        console.log(responseUpload.data)
                        console.log(responseUpload.data["erroreUpload"]);
                    } else {
                        formData.append('immagine', responseUpload.data["fileName"]);

                        axios.post('./api/modifypost-api.php', formData).then(() => {
                            alert("Post modificato con successo!");
                            window.location.href = "./profile.php?username=" + username;
                        });
                    }
                });
            } else {
                console.log("Non carico l'immagine nuova in quanto nulla, modifico solo testo");
                axios.post('./api/modifypost-api.php', formData).then(() => {
                    alert("Post modificato con successo!");
                    window.location.href = "./profile.php?username=" + username;
                });
            }
        });
    }
});
