const params = new URLSearchParams(window.location.search);
const idPost = params.get("idPost");
const noImgLabel = document.getElementById("noImg");
const postImg = document.getElementById("img");
const oldHashtag1 = document.getElementById("hashtag1");
const oldHashtag2 = document.getElementById("hashtag2");
const oldHashtag3 = document.getElementById("hashtag3");
let oldImageName = ""
const newImg = document.getElementById("upload-image");
const removeImgButton = document.getElementById("removeImgButton");
let removeOldImg = false;
let username;


const formData = new FormData();
formData.append('idPost', idPost);

axios.post('./api/getPost.php', formData).then(response => {
    if(response != null) {
        if(response.data[0].immagine != null) {
            noImgLabel.style.display = "none";
            img.setAttribute("src", "./img/" + response.data[0].immagine);
            document.getElementById("image").appendChild(img);
            oldImageName = document.getElementById("img").getAttribute("src").split("/")[2]

            removeImgButton.addEventListener("click", () => {
                removeOldImg = true;
            });
        } else {
            postImg.style.display = "none";
            removeImgButton.style.display = "none";
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
    postImg.style.display = "none";
    removeImgButton.style.display = "none";
    noImgLabel.style.display = "block";
});

newImg.addEventListener("change", event => {
    if(newImg.files[0] == null) {
        postImg.style.display = "none";
        removeImgButton.style.display = "none";
        noImgLabel.style.display = "block";
    } else {
        postImg.style.display = "block";
        removeImgButton.style.display = "block";
        noImgLabel.style.display = "none";
        let output = document.getElementById('img');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    }
});

document.getElementById("modifyPostForm").addEventListener("submit", (event) => {
    event.preventDefault()
    const formData = new FormData();
    const newImg = newImg.files[0];

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

    if(newImg != null) {
        const formDataImage = new FormData();
        formDataImage.append('image', newImg);

        //delete post image from file system
        const formDataDelete = new FormData()
        formDataDelete.append("image", oldImageName)
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
            window.location.href = "./profilo.php?id=" + username;
        });
    }
});
