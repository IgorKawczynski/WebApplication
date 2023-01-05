// Funkcje do trzech animacji ->
// 1. Do powiększenia przy jednorazowym kliknięciu w blok
// 2. Do powiększania przy każdym najechaniu kursorem w blok
// 3. Do powiększania i rozjaśniania przy każdym kliknięciu w blok

function animation1() {
    $("#btn1").on("click", function () {
        $(this).animate({
            width: 500,
            opacity: 0.4,
            fontSize: "3em",
            borderWidth: "10px"
        }, 1500);
    });
}

function animation2() {
    $("#btn2").on({
        "mouseover": function () {
            $(this).animate({
                width: 300
            }, 800);
        },
        "mouseout": function () {
            $(this).animate({
                width: 200
            }, 800);
        }
    });
}


function animation3() {
    $("#btn3").on("click", function () {
        if (!$(this).is(":animated")) {
            $(this).animate({
                width: "+=" + 50,
                height: "+=" + 10,
                opacity: "-=" + 0.1,
                duration: 3000 //inny sposob na okreslenie ile czasu ma trwac animacja
            });
        }
    });
}