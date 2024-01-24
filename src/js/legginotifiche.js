document.addEventListener("DOMContentLoaded", function () {
    const notifications = document.querySelectorAll(".notification");
    notifications.forEach((n) => {
        n.addEventListener("click", function () {
            if (!this.classList.contains("seen")) {
                const id = n.id;
                const curr = document.getElementById(id);
                curr.style.opacity = "0.5";
                const formData = new FormData();
                formData.append("id", id);
                axios.post("api/readnotifications.php", formData);
                this.classList.add("seen");
            }
        });
    });
});