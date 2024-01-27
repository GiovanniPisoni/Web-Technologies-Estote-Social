document.getElementById("elimina").addEventListener("click", () => {
    if(confirm("Sei sicuro di voler eliminare il post?")) {
        const formData = new FormData();
        const idPost = document.getElementById("elimina").value;
        formData.append('idPost', idPost)

        axios.post('./api/deletepost-api.php', formData).then(() => {
            location.reload();
        });
    }
});

document.getElementById("modifica").addEventListener("click", () => {
    window.location.href = "./modifica-post.php?idPost=" + document.getElementById("modifica").value;
});