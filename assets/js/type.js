const first = document.querySelector('#mainSentence').getAttribute('data-value')

let text;

function selectText(nbr) {
    return text = document.querySelector('#sentence'+nbr).getAttribute('data-value')

}


let y =1;
let num = 0;
let innerHome = document.querySelector('#innerHtml');

firstInterval(writeText, 150, first);

let writeIntervals;
let clearIntervals;

function firstInterval(func, time, param) {
    writeIntervals = setInterval(func, time, param);
}

function secondInterval(func, time, param) {
    clearIntervals = setInterval(func, time, param);
}




function writeText(text) {
    if (num > text.length-1){
        clearInterval(writeIntervals);
        if (y <= 3) {
            let words = selectText(y);
            setTimeout(secondInterval, 500, clearText, 35, words);
            y++;
        }

    } else {
        innerHome.innerHTML += text[num];
        num++;
    }
}

function clearText(text) {

    if (innerHome.textContent.length === 0) {
        clearInterval(clearIntervals)

        num = 0;
        firstInterval(writeText, 150, text)

    }
    innerHome.innerHTML = innerHome.innerHTML.slice(0, -1)
}




