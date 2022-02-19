// Show/Hide Password
document.addEventListener("DOMContentLoaded", function(event) {

    let togglePassword = document.querySelector('#toggle_password');
    let toggleConfirmPassword = document.querySelector('#toggle_confirm_password');
    let password = document.querySelector('#password');
    let confirmPassword = document.querySelector('#confirm_password');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

});
