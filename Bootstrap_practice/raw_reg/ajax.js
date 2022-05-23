function showDistrict(divisionId) {
    //console.log(divisionId);return false;
     document.getElementById("district").innerHTML = "<option value='0'>--- Select District ---</option>";
     document.getElementById("thana").innerHTML = "<option value='0'>--- Select Thana ---</option>";
     
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


function showTha(thanaId) {
    //console.log(divisionId);return false;
    if (thanaId == " ") {
        document.getElementById("thana").innerHTML = "no found";
        return;
    }


    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "thana.php?id=" + thanaId);
    xhttp.send();
    xhttp.onload = function () {
        document.getElementById("thana").innerHTML = this.responseText;

    }
}