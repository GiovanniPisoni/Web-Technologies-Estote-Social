document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const idPost = params.get("idPost");
    const noImgLabel = document.getElementById("cameraIcon");
    const postImg = document.getElementById('imgpost');
    const oldText = document.getElementById("description");
    const oldHashtag1 = document.getElementById("hashtag1");
    const oldHashtag2 = document.getElementById("hashtag2");
    const oldHashtag3 = document.getElementById("hashtag3");
    let oldImageName = ""
    const imgContainer = document.getElementById("container");
    const removeImgButton = document.getElementById("removeImgButton");
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
                document.getElementById("container").appendChild(imgContainer);
                oldImageName = response.data[0].immagine;
            } else {
                imgContainer.style.display = "none";
                removeImgButton.style.display = "none";
                noImgLabel.style.display = "block";
            }
            username = response.data[0].username;
            document.getElementById("description").value = response.data[0].testo;
            document.getElementById("hashtag1").value = response.data[0].hashtag1;
            document.getElementById("hashtag2").value = response.data[0].hashtag2;
            document.getElementById("hashtag3").value = response.data[0].hashtag3;
        }
    });

    removeImgButton.addEventListener("click", event => {
        newImg.value = "";
        imgContainer.style.display = "none";
        removeImgButton.style.display = "none";
        noImgLabel.style.display = "block";
        removeOldImg = true;
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
            let output = document.getElementById('container');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        }
    });

    document.getElementById("modifyPostForm").addEventListener("submit", (event) => {
        event.preventDefault()
        const formData = new FormData();
        const imgContainer = imgContainer.files[0];

        formData.append('idPost', idPost);

        if(removeOldImg) {
            axios.post('./api/deletepostimage-api.php', formData);
            //delete post image from file system
            const formDataDelete = new FormData()
            formDataDelete.append("image", oldImageName)
            axios.post('./api/deleteimage-api.php', formDataDelete)
        }
        formData.append('testo', document.getElementById("description").value);
        formData.append('hashtag1', document.getElementById("hashtag1").value);
        formData.append('hashtag2', document.getElementById("hashtag2").value);
        formData.append('hashtag3', document.getElementById("hashtag3").value);

        if(imgContainer != null) {
            const formDataImage = new FormData();
            formDataImage.append('image', imgContainer);

            //delete post image from file system
            const formDataDelete = new FormData()
            formDataDelete.append("removeimage", oldImageName)
            axios.post('./api/deleteimage-api.php', formDataDelete)

            axios.post('./api/image-api.php', formDataImage).then(responseUpload => {
                if (!responseUpload.data["uploadEseguito"]) {
                    console.log(responseUpload.data["erroreUpload"]);
                } else {
                    formData.append('immagine', responseUpload.data["fileName"]);

                    axios.post('./api/modifypost-api.php', formData).then(() => {
                        alert("Post modificato con successo!");
                        window.location.href = "./profilo.php?id=" + username;
                    });
                }
            });
        } else {
            axios.post('./api/modifypost-api.php', formData).then(() => {
                alert("Post modificato con successo!");
                window.location.href = "./profilo.php?username=" + username;
            });
        }
    });
});
