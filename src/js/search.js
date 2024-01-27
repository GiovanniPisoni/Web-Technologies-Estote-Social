document.getElementById("searchForm").addEventListener("click", event => {
    const input = document.getElementById("searchBar").value;
    event.preventDefault();
    if(input != "") {
        const formData = new FormData();
        formData.append('input', input);
        document.getElementById("result-container").style.display = "block";

        axios.post('./api/search-api.php', formData).then(response => {
            const ul = document.getElementById("result");
            createList(ul, response);
        });
    }
});
