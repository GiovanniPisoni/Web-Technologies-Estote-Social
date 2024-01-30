document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll(".comment.btn.btn-success.border-dark.me-2")
        .forEach((element) => element.addEventListener("click", function () {
            const idPost = element.getAttribute("data-postid");
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

    function createList(ul, response) {
        ul.innerHTML = "";
        if (response.data == false) {
            const li = document.createElement("li");

            li.appendChild(document.createTextNode("Nessun risultato"));
            ul.appendChild(li);
        } else {
            response.data.forEach(element => {
                const li = document.createElement("li");
                const a = document.createElement("a");
                const span = document.createElement("span");
                const row = " " + element.nome + " " + element.cognome;

                span.appendChild(document.createTextNode(element.username));
                li.appendChild(span);

                if (element.testo != null) {
                    li.appendChild(document.createTextNode(" " + element.data));
                    const p = li.appendChild(document.createElement("p"));
                    p.appendChild(document.createTextNode(element.testo));
                    a.setAttribute("href", "profilo.php?id=" + element.username);
                } else {
                    li.appendChild(document.createTextNode(row));
                    a.setAttribute("href", "profilo.php?id=" + element.username);
                }
                a.appendChild(li);
                ul.appendChild(a);
            });
        }
    }
});