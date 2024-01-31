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
            const ul = document.getElementById(type);
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
                const img = document.createElement("img");

                img.setAttribute("src", "./img/" + element.immagineProfilo);
                img.setAttribute("class", "fluid-img rounded-circle overflow-hidden");
                img.setAttribute("width", "30");
                img.setAttribute("height", "30");
                li.appendChild(img);
                if(element.username == null) {
                    a.appendChild(document.createTextNode(element.Username_seguito));
                } else {
                    a.appendChild(document.createTextNode(element.username));
                }
                a.setAttribute("href", "profile.php?username=" + element.username);
                a.setAttribute("class", "user-comment");
                li.appendChild(a);
                
                ul.appendChild(li);
            });
        }
    }
});