var BASE_URL = "http://localhost/";

document.getElementById("form").addEventListener("submit", function (e) {
    e.preventDefault();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Usuario ou senha incorretos") {
                alert(this.responseText);
            } else {

            }
        }
    };
    var data = new FormData(document.getElementById("form"));
    xhttp.open("POST", BASE_URL + 'login/logar/', true);
    console.log(data);
    xhttp.send(data);
});