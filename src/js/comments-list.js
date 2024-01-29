document.querySelectorAll(".comment")
    .forEach((element) => element.addEventListener("click", function() {
        console.log("click comment");
        const idPost = element.getAttribute("data-postid");
        getComments(idPost);
    }));


function getComments(idPost) {
    const formData = new FormData();
    formData.append('idPost', idPost);

    axios.post('./api/commentsgroup-api.php', formData).then(response => {
        console.log("creating comments list");
        const ul = document.getElementById("commentsList");
        createList(ul, response);
    });
}

function createList(ul, response) {
    ul.innerHTML = "";
    if(response.data == false) {
        const li = document.createElement("li");

        li.appendChild(document.createTextNode("Nessun risultato"));
        ul.appendChild(li);
    } else {
        response.data.forEach(element => {
            const li = document.createElement("li");
            const a = document.createElement("a");
            const span = document.createElement("span");

            span.appendChild(document.createTextNode(element.username));
            li.appendChild(span);

            if(element.testo != null) {
                li.appendChild(document.createTextNode(" " + element.data));
                const p = li.appendChild(document.createElement("p"));
                p.appendChild(document.createTextNode(element.testo));
                li.appendChild(p);
                a.setAttribute("href", "profilo.php?id=" + element.username);
            } else {
                a.setAttribute("href", "profilo.php?id=" + element.username);
            }
            a.appendChild(li);
            ul.appendChild(a);
        });
    }
}