let like = document.querySelectorAll(".btn.btn-success.border-dark");

const callBackFunctionLike = () => {
    like.forEach(element => {
        const idPost = element.getAttribute("data-postid");
        const formData = new FormData();
        formData.append('idPost', idPost);

        axios.post('./api/checklike-api.php', formData).then(response => {
            if(response.data["isLiked"] == true){
                if (!element.classList.contains("liked")) {
                    element.classList.add("liked");
                }
            }
        });
    });
}

Array.from(like).forEach((button) => button.addEventListener("click", function() {
    const idPost = button.getAttribute("data-postid");
    const formData = new FormData();
    formData.append('idPost', idPost);

    if(button.classList.contains("liked")){
        button.classList.remove("liked");
        formData.append('remove', true);
        miPiace(formData, true);
    }
    else if(!button.classList.contains("liked")){
        button.classList.add("liked");
        miPiace(formData, false);
    }

    const isLiked = button.classList.contains("liked");
    const imageSrc = isLiked ? 'symbol_liked.png' : 'symbol.png';
    button.querySelector('image').setAttribute('xlink:href','./img/' + imageSrc);
}));

function miPiace(formData, isRemoved) {
    axios.post('./api/like-api.php', formData).then(response => {

        //send notification if like not removed
        if(!isRemoved) {
            let notificationFormData = new FormData();
            notificationFormData.append("type", "like")
            notificationFormData.append("sender", response.data.senderUsername)
            notificationFormData.append("receiver", response.data.receiverUsername)
            axios.post('./api/createnotification-api.php', notificationFormData)
        }

    });
}