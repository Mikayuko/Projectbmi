document.addEventListener("DOMContentLoaded", function () { 
    let bmi = sessionStorage.getItem('bmi');
    if (bmi) {
        document.getElementById('bmiValue').textContent = bmi;

        let knowledgePage = '';
        if (bmi < 18.5) {
            knowledgePage = 'knowledge1.html';
        } else if (bmi >= 18.5 && bmi <= 22.9) {
            knowledgePage = 'knowledge2.html';
        } else if (bmi >= 23 && bmi <= 24.9) {
            knowledgePage = 'knowledge3.html';
        } else if (bmi >= 25 && bmi <= 29.9) {
            knowledgePage = 'knowledge4.html';
        } else {
            knowledgePage = 'knowledge5.html';
        }
        document.getElementById('textBookLink').setAttribute('href', knowledgePage);
        console.log('Knowledge page set to:', knowledgePage);
    } 
});