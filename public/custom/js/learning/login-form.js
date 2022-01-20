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

// Signup form password confirmation
$(".login-form-btn").on('click', function(event) {

    let password = $('#password').find('input[name="password"]').val();
    let password_confirm = $('#confirm_password').find('input[name="confirm-password"]').val();

    if(password !== password_confirm){
        event.preventDefault();
        let validationAlert = "<p class='p-2 bg-deep-pink text-white border-radius-5 text-center'>" +
            "Password and confirm password does not match</p>"
        $("#password-validation").html(validationAlert);
    }else{
        $("#password-validation").empty();
    }

});
