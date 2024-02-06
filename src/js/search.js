document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("searchButton").addEventListener("click", async (event) => {
        const username = document.getElementById("searchButton").dataset.username;
        const input = document.getElementById("searchbar").value;
        event.preventDefault();
        if(input != "") {
            const formData = new FormData();
            formData.append('input', input);
            document.getElementById("userResult").style.display = "block";

            await axios.post('./api/search-api.php', formData).then(response => {
                const ul = document.getElementById("userResult");
                createList(ul, response, username);
            });

            await axios.post('./api/searchpost-api.php', formData).then(response => {
                const ul = document.getElementById("hashtagResult");
                createListPost(ul, response);
            });
        }
    });

    function createList(ul, response, username) {
        ul.innerHTML = "";
        ul.classList.add("list-unstyled");
        if (response.data[0] == null) {
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

    function createListPost(ul, response) {
        ul.innerHTML = "";
        ul.classList.add("list-unstyled");
        if (response.data[0] == null) {
            const li = document.createElement("li");
            li.appendChild(document.createTextNode("Nessun post trovato"));
            ul.appendChild(li);
        } else {
            response.data.forEach(post => {
                const li = document.createElement("li");
                const article = document.createElement("article");
                const divRow = document.createElement("div");
                const divCol = document.createElement("div");
                const imgProfile = document.createElement("img");
                const aProfile = document.createElement("a");
                const pDate = document.createElement("p");
                const imgPost = document.createElement("img");
                const pText = document.createElement("p");
                const divHashtags = document.createElement("div");    
                // Settaggio degli attributi e stili
                article.classList.add("bg-light", "border", "border-dark", "my-4", "px-4", "pt-3", "pb-1", "rounded");
                divRow.classList.add("row");
                divCol.classList.add("col", "text-start");
                imgProfile.src = `./img/${post.immagineProfilo}`;
                imgProfile.alt = "Profile image";
                imgProfile.classList.add("rounded-circle");
                imgProfile.height = "40";
                imgProfile.width = "40";
                aProfile.href = `profile.php?username=${post.username}`;
                aProfile.classList.add("username", "usernameStyle");
                aProfile.textContent = `@${post.username}`;
                pDate.classList.add("ms-1", "mt-1", "mb-0", "smaller-font");
                imgPost.src = `./img/${post.immagine}`;
                imgPost.alt = "Post image";
                imgPost.classList.add("img-fluid", "rounded", "max-size-image");
                pText.classList.add("mt-1", "mb-0", "fst-italic");
                pText.textContent = post.testo;
                divHashtags.classList.add("row");
    
                // Aggiunta degli elementi al DOM
                divCol.appendChild(imgProfile);
                divCol.appendChild(aProfile);
                divCol.appendChild(pDate);
                divRow.appendChild(divCol);
                article.appendChild(divRow);
    
                if (post.immagine) {
                    article.appendChild(imgPost);
                }
    
                article.appendChild(pText);
                if (post.hashtag1 || post.hashtag2 || post.hashtag3) {
                    const hashtags = [post.hashtag1, post.hashtag2, post.hashtag3].filter(Boolean);
                    const pHashtags = document.createElement("p");
                    pHashtags.classList.add("smaller-font");
                    pHashtags.textContent = hashtags.join(' ');
                    divHashtags.appendChild(pHashtags);
                    article.appendChild(divHashtags);
                }

                li.appendChild(article);
                ul.appendChild(li);
            });
        }
    }
    
});