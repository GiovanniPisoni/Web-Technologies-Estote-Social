document.getElementById("elimina").addEventListener("click", () => {
    if(confirm("Sei sicuro di voler eliminare il post?")) {
        const formData = new FormData();
        const idPost = document.getElementById("elimina").dataset.postid;
        console.log(idPost);
        formData.append('idPost', idPost)

        axios.post('./api/deletepost-api.php', formData).then(() => {
            location.reload();
        });
    }
});