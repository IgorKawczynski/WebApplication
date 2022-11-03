/* IMPLEMENTACJA ZEGARA */

function currentTime() {

    let date = new Date();
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();

    hh = (hh < 10) ? "0" + hh : hh;
    mm = (mm < 10) ? "0" + mm : mm;
    ss = (ss < 10) ? "0" + ss : ss;

    let time = hh + ":" + mm + ":" + ss;

    document.getElementById("clock").innerText = time;
    var t = setTimeout(function () { currentTime() }, 1000);

}
currentTime();


function homePanelActivate() {
    const btn = document.querySelector('button');
    const home = document.querySelector('.home');
    const toggleState = (event) => {
        event.preventDefault();

        home.classList.toggle('home--teams');
    };

    btn.addEventListener('click', toggleState, false);
}

homePanelActivate();