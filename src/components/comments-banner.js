const callBackFunctionComments = () => {
    let commentButtons = document.querySelectorAll(".comment.btn.btn-success.border-dark.me-2")

    commentButtons.forEach(element => element.addEventListener("click", event => {
        let postId = event.currentTarget.getAttribute("data-postid")
        document.getElementById("postHidden").value = postId
    }))
}