let slide = document.querySelectorAll('.slide');
let currentSlide = 0;
let currentDescription = 0;
let index = document.querySelector('.containerIndex');
let para = document.querySelectorAll('p');

function displayTrue() {
    for (let i = 0; i < slide.length; i++)
    {
        slide[i].style.display = 'none';

    }
}

function show() {
    let x = 0.4;
    let intX = setInterval(function () {
        x += 0.1;
        slide[currentSlide].style.opacity = x;
        if (x >= 1) {
            clearInterval(intX);
            x = 0.4;
        }
    }, 100);
}

function displayDescription() {

    for (let u = 0; u < para.length; u++) {
        para[u].style.visibility = 'visible'
        para[u].style.transform = 'translateY(0)'
        para[u].style.transition = '5s'
        para[currentDescription].style.opacity = '1'
        para[u].classList.add("lorem");
    }
}


function next() {
    displayTrue();
    displayDescription();

    if (currentSlide === slide.length - 1) currentSlide = -1;
    currentSlide++;

    slide[currentSlide].style.display = 'block';
    slide[currentSlide].style.opacity = 0.4;


    if (currentDescription === para.length - 1) currentDescription = -1;
    currentDescription++;

    para[currentDescription].style.visibility = 'hidden';
    para[currentDescription].style.transform = 'translateY(200px)'
    para[currentDescription].style.opacity = '0'


    show();

}

function prev() {
    displayTrue();
    displayDescription();

    if (currentSlide === 0) currentSlide = slide.length;
    currentSlide--;

    slide[currentSlide].style.display = 'block';
    slide[currentSlide].style.opacity = 0.4;

    if (currentDescription === 0) currentDescription = para.length;
    currentDescription--;

    para[currentDescription].style.visibility = 'hidden';
    para[currentDescription].style.transform = 'translateY(200px)'
    para[currentDescription].style.opacity = '0'


    show();

}

function start() {
    displayTrue();
    slide[currentSlide].style.display = 'block';
    para[currentDescription].style.visibility = 'hidden';
    para[currentDescription].style.transform = 'translateY(200px)'
    para[currentDescription].style.opacity = '0'
    show();
}

start();

let imageBox = document.querySelector('#test');

    if (window.matchMedia("(min-width: 600px)").matches) {
        console.log('test1')
    } else {
        console.log('test2')

    }





