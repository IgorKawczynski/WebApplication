function validateForm() {

    var name = document.getElementById('form3').value;
    if (name == "") {
        document.querySelector('.status').innerHTML = "Imie nie może być puste !";
        console.log("Imie nie może być puste !");
        return false;
    }

    var email = document.getElementById('form3_2').value;
    if (email == "") {
        document.querySelector('.status').innerHTML = "E-mail nie może być pusty !";
        console.log("E-mail nie może być pusty !");
        return false;
    }
    else {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)) {
            document.querySelector('.status').innerHTML = "Zły format adresu e-mail !";
            console.log("Zły format adresu e-mail !");
            return false;
        }
    }

    var password = document.getElementById('form3_3').value;
    if (password == "") {
        document.querySelector('.status').innerHTML = "Hasło nie może być puste !";
        console.log("Hasło nie może być puste !");
        return false;
    }
    if (password.length < 6) {
        document.querySelector('.status').innerHTML = "Hasło musi mieć przynajmniej 6 znaków !";
        console.log("Hasło musi mieć przynajmniej 6 znaków !");
        return false;
    }

    var password2 = document.getElementById('form3_4').value;
    if (password2 != password) {
        document.querySelector('.status').innerHTML = "Powtórzone hasło musi być takie samo jak wyżej !";
        console.log("Powtórzone hasło musi być takie samo jak wyżej !");
        return false;
    }
    document.querySelector('.status').innerHTML = "Wysyłam...";
}