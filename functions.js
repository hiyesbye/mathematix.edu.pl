function pojawUkryjNastępnyElement(element) {
    let arrayOfElements = [...element.parentElement.querySelectorAll('*')]
    let elementIndex = arrayOfElements.indexOf(element)
    arrayOfElements[elementIndex+1].classList.toggle('widoczny')
}
