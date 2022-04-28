function  changeStatus(userId, status) {

    let text = "Do you want to change!\nPress a button!\nEither OK or Cancel.";
    if (confirm(text) == true) {

        if (userId == " ") {
            return;
        }

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("btn-status" + userId).innerHTML = this.responseText;
            }
        }


        xhttp.open("GET", "changeStatus.php?id=" + userId + "&stat=" + status + "&btn=" + 0);
        xhttp.send();

        const xhttp1 = new XMLHttpRequest();

        xhttp1.onload = function ()
        {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("btn-status2" + userId).innerHTML = this.responseText;
            }
        }

        xhttp1.open("GET", "changeStatus.php?id=" + userId + "&stat=" + status + "&btn=" + 1);
        xhttp1.send();

    } else {
        text = "You canceled!";
        document.getElementById("btn-status").innerHTML = text;
    }




}