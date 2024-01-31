document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("follower").addEventListener("click", function () {
        getUsersList("follower");
    });

    document.getElementById("seguiti").addEventListener("click", function () {
        getUsersList("seguiti");
    });

    function getUsersList(type) {
        const params = new URLSearchParams(window.location.search);
        username = params.get('username');

        const formData = new FormData();
        formData.append('username', username);
        formData.append('listType', type);

        axios.post('./api/userslist-api.php', formData).then((response) => {
            const ul = document.getElementById("usersList");
            createList(ul, response);
        });
    }

    function createList(ul, response) {
        ul.innerHTML = "";
        if (response.data == false) {
            const li = document.createElement("li");

            li.appendChild(document.createTextNode("Nessun utente da mostrare :("));
            ul.appendChild(li);
        } else {
            response.data.forEach(element => {
                const li = document.createElement("li");
                const a = document.createElement("a");
                const imgDiv = document.createElement("div");

                imgDiv.style.width = "30px";
                imgDiv.style.height = "30px";
                imgDiv.style.borderRadius = "50%";
                imgDiv.style.backgroundImage = "url('./img/" + element.immagineProfilo + "')";
                imgDiv.style.backgroundSize = "cover";
                imgDiv.style.marginRight = "10px";
                li.style.display = "flex";
                li.style.alignItems = "center";

                li.appendChild(imgDiv);

                if(element.username == null) {
                    a.appendChild(document.createTextNode(element.username_seguito));
                    a.setAttribute("href", "profile.php?username=" + element.username_seguito);
                } else {
                    a.appendChild(document.createTextNode(element.username));
                    a.setAttribute("href", "profile.php?username=" + element.username);
                }

                a.setAttribute("class", "user-comment");
                li.appendChild(a);
                
                ul.appendChild(li);
            });
        }
    }
});