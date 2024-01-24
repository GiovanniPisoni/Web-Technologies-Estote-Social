let flower = document.querySelectorAll(".flower");

const callBackFunctionLike = () => {
    flower.forEach(element => {
        const idPost = element.dataset.idPost;
        const formData = new FormData();
        formData.append('idPost', idPost);

        axios.post('./api/checklike-api.php', formData).then(response => {
            if(response.data["isLiked"] == true){
                if(!element.classList.contains("liked")){
                    element.classList.add("liked");
                }
            }
        });
    });
}

flower.forEach((element) => element.addEventListener("click", function() {
    const idPost = element.getAttribute("idPost");
    miPiace(this, idPost);
}));

function miPiace(button, idPost){
    const formData = new FormData();
    formData.append('idPost', idPost);

    if(button.classList.contains("liked")){
        button.classList.remove("liked");
        formData.append('remove', true);
        like(formData, true);
    }
    else if(!button.classList.contains("liked")){
        button.classList.add("liked");
        like(formData, false);
    }
}

function like(formData, isRemoved) {
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

/**
 * Observer to check updatePost container changes and then trigger callback 
 *
const postContainerLike = document.getElementById('postContainer');
callBackFunctionLike()

var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
var observerLike = new MutationObserver(callBackFunctionLike);
observerLike.observe(postContainerLike, {
    childList: true
});
*/