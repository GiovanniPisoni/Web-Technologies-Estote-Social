let button = document.getElementById("seguiButton");
const usernameseguito = button.dataset.usernameseguito;

const callBackFunctionFollow = () => {
    const formData = new FormData();
    formData.append('usernameseguito', usernameseguito);

    axios.post('./api/checkfollow-api.php', formData).then(response => {
        if(response.data["followed"] == true){
            if (!button.classList.contains("followed")) {
                button.classList.add("followed");
            }
        }
    });
}

button.addEventListener("click", function() {
    const formData = new FormData();
    formData.append('usernameseguito', usernameseguito);

    if(button.classList.contains("followed")){
        if(confirm("Vuoi davvero smettere di seguire questo utente?")) {
            button.classList.remove("followed");
            formData.append('remove', true);
            segui(formData, true);
        }
    }
    else if(!button.classList.contains("followed")){
        button.classList.add("followed");
        segui(formData, false);
    }

    const isFollowed = button.classList.contains("followed");
    button.innerHTML = isFollowed ? 'Segui già' : 'Segui';
    document.getElementById("numFollower").innerHTML = isFollowed ? parseInt(document.getElementById("numFollower").innerHTML) + 1 : parseInt(document.getElementById("numFollower").innerHTML) - 1;
});

function segui(formData, isRemoved) {
    axios.post('./api/follow-api.php', formData).then(response => {

        //send notification if follow not removed
        if(!isRemoved) {
            let notificationFormData = new FormData();
            notificationFormData.append("type", "follow")
            notificationFormData.append("sender", response.data.senderUsername)
            notificationFormData.append("receiver", response.data.receiverUsername)
            axios.post('./api/createnotification-api.php', notificationFormData)
        }
    });
}