<br />
<b>Warning</b>:  Unknown: Input variables exceeded 1000. To increase the limit change max_input_vars in php.ini. in <b>Unknown</b> on line <b>0</b><br />
function pojawUkryjNastępnyElement(element) {
    let arrayOfElements = [...element.parentElement.querySelectorAll('*')]
    let elementIndex = arrayOfElements.indexOf(element)
    console.log(arrayOfElements[elementIndex+1])
    arrayOfElements[elementIndex+1].classList.toggle('widoczny')
}

// // uruchom funkcję kiedy użytkownik użyje scrolla
// window.onscroll = function() {myFunction()};

// // weź dropdown
// var navbar = document.getElementById("navbar");

// // pobierz pozycję navbar
// var sticky = navbar.offsetTop;

// // Dodaj klasę sticky do navbar kiedy osiągnie pozycję scrolla. Usuń klasę "sticky" kiedy opuścisz pozycję scrolla
// function myFuncti