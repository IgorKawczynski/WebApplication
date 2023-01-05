// Prosta Walidacja -> wszystko wg. komentarzy
function validateForm() {
    var email = document.getElementById('form3').value;
    if (email == "") {
        document.querySelector('.status').innerHTML = "E-mail nie może być pusty !";
        return false;
    } else {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)) {
            document.querySelector('.status').innerHTML = "Zły format adresu e-mail !";
            return false;
        }
    }
    var password = document.getElementById('form3_2').value;
    if (password == "") {
        document.querySelector('.status').innerHTML = "Hasło nie może być puste !";
        return false;
    }
    if (password.length < 6) {
        document.querySelector('.status').innerHTML = "Hasło musi mieć przynajmniej 6 znaków !";
        return false;
    }
    var password2 = document.getElementById('form3_3').value;
    if (password2 != password) {
        document.querySelector('.status').innerHTML = "Powtórzone musi być takie samo jak wyżej !";
        return false;
    }
    document.querySelector('.status').innerHTML = "Wysyłam...";
}