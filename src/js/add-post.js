const image = document.getElementById('imgpost');
const camera = document.getElementById("cameraIcon");
const imgContainer = document.getElementById("container");
const removeImgButton = document.getElementById("removeImgButton");

imgContainer.style.display = "none";
removeImgButton.style.display = "none";

image.addEventListener('change', (e) => {
    if(image.files[0] == null) {
        imgContainer.style.display = "none";
        removeImgButton.style.display = "none";
        camera.style.display = "block";
    } else {
        imgContainer.style.display = "block";
        removeImgButton.style.display = "block";
        camera.style.display = "none";
        var output = document.getElementById('container');
        output.src = URL.createObjectURL(e.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    }
});

removeImgButton.addEventListener("click", event => {
    image.value = "";
    imgContainer.style.display = "none";
    removeImgButton.style.display = "none";
    camera.style.display = "block";
});

// aggiungo il post
document.querySelector("#addPostForm").addEventListener("submit", function (event) {
    event.preventDefault()
    
    const formData = new FormData();
    const img = image.files[0];
    const text = document.getElementById('description').innerText;
    const hashtag1 = document.getElementById('hashtag1').innerText;
    const hashtag2 = document.getElementById('hashtag2').innerText;
    const hashtag3 = document.getElementById('hashtag3').innerText;

    formData.append('testo', text);
    formData.append('hashtag1', hashtag1);
    formData.append('hashtag2', hashtag2);
    formData.append('hashtag3', hashtag3);

    
    if(img != null) {
        const formDataImage = new FormData();
        formDataImage.append('image', img);
        axios.post('./api/image-api.php', formDataImage).then((responseUpload) => {
            if (!responseUpload.data["uploadEseguito"]) {
                alert("Qualcosa è andato storto :/");
                window.location.href = "./index.php";
            }else{
                formData.append('immagine', responseUpload.data["fileName"]);
                axios.post('./api/newpost-api.php', formData).then((response) => {
                    alert("Post aggiunto con successo!");     
                    window.location.href = "./index.php";
                });
            }    
        });
    }else{
        if(text.length === 0){
            alert("Parametri assenti!");
            window.location.href = "./index.php";
        }else{
            axios.post('./api/newpost-api.php', formData).then((response) => {
                alert("Post aggiunto con successo!");
                console.log(response.data);
                window.location.href = "./index.php";
            });
        }
    }
});