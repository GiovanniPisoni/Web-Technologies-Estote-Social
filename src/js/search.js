document.getElementById("searchButton").addEventListener("click", event => {
    const username = document.getElementById("searchButton").dataset.username;
    const input = document.getElementById("searchbar").value;
    event.preventDefault();
    if(input != "") {
        const formData = new FormData();
        formData.append('input', input);
        document.getElementById("userResult").style.display = "block";

        axios.post('./api/search-api.php', formData).then(response => {
            const ul = document.getElementById("userResult");
            createList(ul, response, username);
        });
    }
});

function createList(ul, response, username) {
    ul.innerHTML = "";
    if (response.data == false) {
        const li = document.createElement("li");

        li.appendChild(document.createTextNode("Nessun utente trovato"));
        ul.appendChild(li);
    } else {
        response.data.forEach(element => {
            if(element.username != username) {
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

                a.appendChild(document.createTextNode(element.username));
                a.setAttribute("href", "profile.php?username=" + element.username);

                a.setAttribute("class", "user-comment");
                li.appendChild(a);
                
                ul.appendChild(li);
            }
        });
    }
}
