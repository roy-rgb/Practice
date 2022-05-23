function showAddress(userId) {

    if (userId == " ") {
        document.getElementById("modal-body").innerHTML = "no found";
        return;
    }


    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "addModal.php?id=" + userId);
    xhttp.send();
    xhttp.onload = function () {
        document.getElementById("modal-body").innerHTML = this.responseText;

    }
}