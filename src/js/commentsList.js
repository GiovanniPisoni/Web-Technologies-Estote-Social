document.querySelectorAll(".comment")
    .forEach((element) => element.addEventListener("click", function() {
        const idPost = element.getAttribute("idPost");
        getComments(idPost);
    }));


function getComments(idPost) {
    const formData = new FormData();
    formData.append('idPost', idPost);

    axios.post('./api/commentsgroup-api.php', formData).then(response => {
        const ul = document.getElementById("commentsList");
        createList(ul, response);
    });
}
