document.addEventListener("DOMContentLoaded", function () {
    const notifications = document.querySelectorAll(".notification-text");
    const deleteButtons = document.querySelectorAll(".delete-notification");

    notifications.forEach((n) => {
        n.addEventListener("click", function () {
            const id = n.dataset.id;
            const curr = document.getElementById(id);
            curr.style.opacity = "0.5";
            const formData = new FormData();
            formData.append("id", id);
            axios.post("api/readnotification.php", formData);
            curr.classList.add("seen");
        });
    });

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevents click on the notification text
            const id = button.dataset.id;
            const formData = new FormData();
            formData.append("idNotifica", id);
            axios.post("api/deletenotification.php", formData)
                .then(response => {
                    // Handle success (you may want to remove the notification from the DOM)
                    console.log(response.data);
                    location.reload();
                })
                .catch(error => {
                    // Handle error
                    console.error(error);
                });
        });
    });
});
