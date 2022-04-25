function showDistrict(divisionId) {
    //console.log(divisionId);return false;
    if (divisionId == " ") {
        document.getElementById("district").innerHTML = "no found";
        return;
    }


    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "district.php?id=" + divisionId);
    xhttp.send();
    xhttp.onload = function () {
        document.getElementById("district").innerHTML = this.responseText;

    }
}