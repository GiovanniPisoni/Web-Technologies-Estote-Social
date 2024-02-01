document.addEventListener("DOMContentLoaded", () => {
    document.querySelector('#postContainer').addEventListener('click', function(event) {
        const linkElement = event.target.closest('a');
        if (linkElement) {
            const idPost = linkElement.getAttribute('data-postid');
            const noImgLabel = document.getElementById("cameraIconModify");
            const postImg = document.getElementById('imgpostModify');
            const imgContainer = document.getElementById("containerModify");
            const removeImgButton = document.getElementById("removeImgButtonModify");
            let oldImageName = "";
            let currImgName = "";
            let removeOldImg = false;
            let username;

            const formData = new FormData();
            formData.append('idPost', idPost);

            axios.post('./api/getpost-api.php', formData).then(response => {
                if(response != null) {
                    if(response.data[0].immagine != null) {
                        noImgLabel.style.display = "none";
                        imgContainer.style.display = "block";
                        removeImgButton.style.display = "block";
                        imgContainer.setAttribute("src", "./img/" + response.data[0].immagine);
                        oldImageName = response.data[0].immagine;
                        currImgName = response.data[0].immagine;
                    } else {
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
                }
                currImgName = "";
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
                    axios.post('./api/deletepostimage-api.php', formData);
                    //delete post image from file system
                    /*const formDataDelete = new FormData()
                    formDataDelete.append("removeimage", oldImageName)
                    axios.post('./api/deleteimage-api.php', formDataDelete).then(response => {
                        if (!response.data["eliminazione"]) {
                            console.log(response.data);
                        }
                    });*/
                }
                formData.append('testo', document.getElementById("descriptionModify").value);
                formData.append('hashtag1', document.getElementById("hashtag1Modify").value);
                formData.append('hashtag2', document.getElementById("hashtag2Modify").value);
                formData.append('hashtag3', document.getElementById("hashtag3Modify").value);

                if(postImg.files[0] != null) {
                    const formDataImage = new FormData();
                    let newimg = postImg.files[0];
                    formDataImage.append('image', newimg);

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
                    axios.post('./api/modifypost-api.php', formData).then(() => {
                        alert("Post modificato con successo!");
                        window.location.href = "./profile.php?username=" + username;
                    });
                }
            });
        }
    });
});