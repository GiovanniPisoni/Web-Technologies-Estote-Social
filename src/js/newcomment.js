document.getElementById("commentForm").addEventListener("submit", event => {
    event.preventDefault()
    const formData = new FormData();
    const postId = document.getElementById("postHidden").value;
    formData.append('input', document.getElementById("commentText").value)
    formData.append('postId', postId)

    axios.post('./api/comment-api.php', formData).then(response => {
        
        //send notification
        let notificationFormData = new FormData();
        notificationFormData.append("type", "comment")
        notificationFormData.append("sender", response.data.senderUsername)
        notificationFormData.append("receiver", response.data.receiverUsername)
        notificationFormData.append("post", postId)
        axios.post('./api/createnotification-api.php', notificationFormData)
        
        getComments(postId);
    });

    document.getElementById("commentForm").reset()
});
