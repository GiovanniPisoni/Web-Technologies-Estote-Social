document.getElementById("commentForm").addEventListener("submit", event => {
    event.preventDefault()
    const formData = new FormData();
    const idPost = document.getElementById("postHidden").value;
    formData.append('text', document.getElementById("commentText").value)
    formData.append('idPost', idPost)

    axios.post('./api/comment-api.php', formData).then(response => {
        
        //send notification
        let notificationFormData = new FormData();
        notificationFormData.append("type", "comment")
        notificationFormData.append("sender", response.data.senderUsername)
        notificationFormData.append("receiver", response.data.receiverUsername)
        axios.post('./api/createnotification-api.php', notificationFormData)
        
        getComments(idPost);
    });

    document.getElementById("commentForm").reset()
});
