document.querySelector('.calculate').addEventListener('click', function () {
    let weight = document.getElementById('weight').value;
    let height = document.getElementById('height').value;
    let age = document.getElementById('age').value;
    let genderElements = document.querySelectorAll('input[name="gender"]:checked');
    let gender = genderElements.length > 0 ? genderElements[0].value : null;

    if (weight && height && age && gender) {
        let bmi = (weight / ((height / 100) ** 2)).toFixed(2);
        sessionStorage.setItem('bmi', bmi);
        window.location.href = 'result.html';
    } else {
        alert("Please fill in all fields.");
    }
});

document.querySelector('.clear').addEventListener('click', function () {
    document.getElementById('weight').value = '';
    document.getElementById('height').value = '';
    document.getElementById('age').value = '';
    document.querySelectorAll('input[name="gender"]').forEach(input => input.checked = false);
});

document.querySelectorAll('input[name="gender"]').forEach(input => {
    input.addEventListener('change', function () {
        let selectedGenders = document.querySelectorAll('input[name="gender"]:checked');
        if (selectedGenders.length > 1) {
            alert('Please select only one gender.');
            this.checked = false;
        }
    });
});