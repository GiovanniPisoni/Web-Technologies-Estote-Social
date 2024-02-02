document.addEventListener("DOMContentLoaded", () => {
    let deleteLinks = document.querySelectorAll('.eliminaPost');
    deleteLinks.forEach(link => {
        link.addEventListener('click', event => {
            if(confirm("Sei sicuro di voler eliminare il post?")) {
                const formData = new FormData();
                let idPost = event.currentTarget.getAttribute('data-postid');
                formData.append('idPost', idPost);

                axios.post('./api/deletepost-api.php', formData).then(() => {
                    location.reload();
                });
            }
        });
    });
});