const pipe = document.getElementById('pipe');

function hidePipe() {
    pipe.style.opacity = '0%';
//    console.log('hide')
    setTimeout(showPipe, 500);
}
function showPipe() {
    pipe.style.opacity = '100%';
//    console.log('show')
}

setInterval(hidePipe, 1000)


