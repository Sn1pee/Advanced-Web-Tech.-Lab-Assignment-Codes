const form = document.getElementById("registrationForm");

const nameInput = document.getElementById("name");
const emailInput = document.getElementById("email");
const mobileInput = document.getElementById("mobile");
const departmentInput = document.getElementById("department");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirmPassword");

const successMessage = document.getElementById("successMessage");


function showError(input, errorId, message) {
    const error = document.getElementById(errorId);

    error.textContent = message;

    input.classList.add("error");
    input.classList.remove("valid");
}


function removeError(input, errorId) {
    const error = document.getElementById(errorId);

    error.textContent = "";

    input.classList.remove("error");
    input.classList.add("valid");
}


function validateName() {

    const name = nameInput.value.trim();
    const namePattern = /^[A-Za-z ]+$/;

    if (name === "") {
        showError(nameInput, "nameError", "Name is required.");
        return false;
    }

    if (name.length < 3) {
        showError(nameInput, "nameError",
            "Name must contain at least 3 characters.");
        return false;
    }

    if (!namePattern.test(name)) {
        showError(nameInput, "nameError",
            "Name should contain only letters.");
        return false;
    }

    removeError(nameInput, "nameError");
    return true;
}


function validateEmail() {

    const email = emailInput.value.trim();

    const emailPattern =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {
        showError(emailInput, "emailError",
            "Email address is required.");
        return false;
    }

    if (!emailPattern.test(email)) {
        showError(emailInput, "emailError",
            "Please enter a valid email address.");
        return false;
    }

    removeError(emailInput, "emailError");
    return true;
}


function validateMobile() {

    const mobile = mobileInput.value.trim();

    const mobilePattern = /^[6-9][0-9]{9}$/;

    if (mobile === "") {
        showError(mobileInput, "mobileError",
            "Mobile number is required.");
        return false;
    }

    if (!mobilePattern.test(mobile)) {
        showError(mobileInput, "mobileError",
            "Enter a valid 10-digit mobile number.");
        return false;
    }

    removeError(mobileInput, "mobileError");
    return true;
}


function validateDepartment() {

    if (departmentInput.value === "") {
        showError(departmentInput, "departmentError",
            "Please select a department.");
        return false;
    }

    removeError(departmentInput, "departmentError");
    return true;
}


function validatePassword() {

    const password = passwordInput.value;

    if (password === "") {
        showError(passwordInput, "passwordError",
            "Password is required.");
        return false;
    }

    if (password.length < 8) {
        showError(passwordInput, "passwordError",
            "Password must contain at least 8 characters.");
        return false;
    }

    if (!/[A-Z]/.test(password)) {
        showError(passwordInput, "passwordError",
            "Password must contain an uppercase letter.");
        return false;
    }

    if (!/[a-z]/.test(password)) {
        showError(passwordInput, "passwordError",
            "Password must contain a lowercase letter.");
        return false;
    }

    if (!/[0-9]/.test(password)) {
        showError(passwordInput, "passwordError",
            "Password must contain a number.");
        return false;
    }

    removeError(passwordInput, "passwordError");
    return true;
}


function validateConfirmPassword() {

    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (confirmPassword === "") {
        showError(confirmPasswordInput,
            "confirmPasswordError",
            "Please confirm your password.");
        return false;
    }

    if (password !== confirmPassword) {
        showError(confirmPasswordInput,
            "confirmPasswordError",
            "Passwords do not match.");
        return false;
    }

    removeError(confirmPasswordInput,
        "confirmPasswordError");

    return true;
}


nameInput.addEventListener("input", validateName);

emailInput.addEventListener("input", validateEmail);

mobileInput.addEventListener("input", validateMobile);

departmentInput.addEventListener("change",
    validateDepartment);

passwordInput.addEventListener("input", function () {
    validatePassword();

    if (confirmPasswordInput.value !== "") {
        validateConfirmPassword();
    }
});

confirmPasswordInput.addEventListener(
    "input",
    validateConfirmPassword
);


nameInput.addEventListener("blur", validateName);

emailInput.addEventListener("blur", validateEmail);

mobileInput.addEventListener("blur", validateMobile);

passwordInput.addEventListener("blur",
    validatePassword);

confirmPasswordInput.addEventListener(
    "blur",
    validateConfirmPassword
);


form.addEventListener("submit", function (event) {

    event.preventDefault();

    const isNameValid = validateName();
    const isEmailValid = validateEmail();
    const isMobileValid = validateMobile();
    const isDepartmentValid = validateDepartment();
    const isPasswordValid = validatePassword();
    const isConfirmPasswordValid =
        validateConfirmPassword();

    if (
        isNameValid &&
        isEmailValid &&
        isMobileValid &&
        isDepartmentValid &&
        isPasswordValid &&
        isConfirmPasswordValid
    ) {

        successMessage.textContent =
            "Registration completed successfully!";

        successMessage.style.display = "block";

    } else {

        successMessage.style.display = "none";

    }

});