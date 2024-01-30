document.addEventListener('DOMContentLoaded', (event) => {
    // Seleziona tutti gli elementi con la classe 'likenumber'
    var likeElements = document.querySelectorAll('.likenumber');
    var likeButtons = document.querySelectorAll(".like.btn.btn-success.border-dark");

    // Per ogni elemento, invia una richiesta al server per ottenere il numero di "likes"
    likeElements.forEach((element) => {
        var idPost = element.getAttribute('data-postid');
        const formData = new FormData();
        formData.append('idPost', idPost);

        axios.post('./api/likenumber-api.php', formData).then((response) => {
            var likesCount = response.data["likes"];
            // Stampa il numero di "likes" nell'elemento
            element.textContent = likesCount;
        });
    });

    likeButtons.forEach((button) => {
        button.addEventListener("click", debounce(function() {
            var idPost = button.getAttribute('data-postid');
            var likeElement = document.querySelector(`#like-${idPost}`);
            const formData = new FormData();
            formData.append('idPost', idPost);
    
            axios.post('./api/likenumber-api.php', formData).then((response) => {
                var likesCount = response.data["likes"];
                // Stampa il numero di "likes" nell'elemento
                likeElement.textContent = likesCount;
            });
        }, 150));
    });

    function debounce(func, wait) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                func.apply(context, args);
            }, wait);
        };
    }
});
