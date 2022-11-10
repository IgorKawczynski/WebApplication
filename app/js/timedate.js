/* WŁASNA IMPLEMENTACJA ZEGARA W HOME.JS */

var timerId = null;
var timerRunning = false;

function getTheDate() 
{
    Today = new Date();
    Time = "" + (Today.getMonth() + 1) + " / " + Today.getDate() + " / " + (Today.getYear() - 100);
    document.getElementById("data").innerHTML = Time;
}

function stopClock() 
{
    if(timerRunning)
    {
        clearTimeout(timerId);
    }
    timerRunning = false;
}

function startClock()
{
    stopClock();
    getDate();
    showTime();
}

function showTime()
{
    var now = new Date();
    var hours = now.getHours;
    var minutes = now.getMinutes;
    var seconds = now.getSeconds;
    var miliseconds = now.getMilliseconds;

    var timeValue = "" + ((hours > 12) ? hours - 12 : hours);
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
    timeValue += ((hours >= 12) ? " P.M." : " A.M.");

    document.getElementById("zegar").innerHTML = timeValue;
    timerId = setTimeout("showTime()", 1000);
    timerRunning = true;
}
