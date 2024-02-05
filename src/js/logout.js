document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('logoutIcon').addEventListener('click', function (event) {
        event.preventDefault();
        if(confirm("Sei sicuro di fare il logout?")) {
            axios.get('./api/logout-api.php');
            location.reload();
        }
    });
});