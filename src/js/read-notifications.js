document.addEventListener("DOMContentLoaded", function () {
    const notifications = document.querySelectorAll(".notification-text");

    notifications.forEach((n) => {
        n.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevents click on the notification text
            const id = n.dataset.id;
            const curr = document.getElementById(id);
            curr.style.opacity = "0.5";
            const formData = new FormData();
            formData.append("idNotifica", id);
            axios.post("./api/readnotification-api.php", formData);
            curr.classList.add("seen");
        });
    });

    document.addEventListener("click", function (event) {
        const deleteButton = event.target.closest(".delete-notification");
        if (deleteButton) {
            event.stopPropagation(); // Prevents click on the notification text
            const id = deleteButton.dataset.id;
            const formData = new FormData();
            formData.append("idNotifica", id);
            axios.post("./api/deletenotification-api.php", formData).then(() => {
                const deletedNotification = document.getElementById(id);
                if (deletedNotification) {
                    deletedNotification.remove(); // Rimuovi l'elemento dalla DOM
                }
            });
        }
    });
    
});
