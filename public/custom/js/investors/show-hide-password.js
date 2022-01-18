document.addEventListener("DOMContentLoaded", function(event) {

    let toggleCurrentPassword = document.querySelector('#toggle_current_password');
    let toggleNewPassword = document.querySelector('#toggle_new_password');
    let current_password = document.querySelector('#current_password');
    let new_password = document.querySelector('#new_password');

    toggleCurrentPassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = current_password.getAttribute('type') === 'password' ? 'text' : 'password';
        current_password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

    toggleNewPassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = new_password.getAttribute('type') === 'password' ? 'text' : 'password';
        new_password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

});
