document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll(".comment.btn.btn-success.border-dark.me-2")
        .forEach((element) => element.addEventListener("click", event => {
            const idPost = event.currentTarget.getAttribute("data-postid");
            document.getElementById("postHidden").value = idPost;
            getComments(idPost);
        })
    );

    document.getElementById("commentForm").addEventListener("submit", event => {
        event.preventDefault()
        const formData = new FormData();
        const idPost = document.getElementById("postHidden").value;
        formData.append('text', document.getElementById("commentText").value)
        formData.append('idPost', idPost)
    
        axios.post('./api/comment-api.php', formData).then(response => {
    
            //send notification
            let notificationFormData = new FormData();
            notificationFormData.append("type", "commento")
            notificationFormData.append("sender", response.data.senderUsername)
            notificationFormData.append("receiver", response.data.receiverUsername)
            axios.post('./api/createnotification-api.php', notificationFormData)
    
            getComments(idPost);
        });
    
        document.getElementById("commentForm").reset()
    });

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

            li.appendChild(document.createTextNode("Aggiungi tu il primo commento!"));
            ul.appendChild(li);
        } else {
            response.data.forEach(element => {
                const li = document.createElement("li");
                const a = document.createElement("a");

                a.appendChild(document.createTextNode(element.username));
                a.setAttribute("href", "profile.php?username=" + element.username);
                a.setAttribute("class", "user-comment");
                li.appendChild(a);

                if (element.testo != null) {
                    const date = new Date(element.data);
                    const formattedDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
                    const formattedTime = date.getHours() + ":" + date.getMinutes();
                    const small = document.createElement("small");
                    small.appendChild(document.createTextNode(" " + formattedDate + " alle " + formattedTime));
                    small.setAttribute("class", "small-date");
                    li.appendChild(small);
                    const p = li.appendChild(document.createElement("p"));
                    p.appendChild(document.createTextNode(element.testo));
                    p.setAttribute("class", "comment-text");
                }
                ul.appendChild(li);
            });
        }
    }
});
