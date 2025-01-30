// document.addEventListener("DOMContentLoaded", function () {
//     const dobInput = document.getElementById("dob");

//     if (dobInput) {
//         dobInput.addEventListener("click", function () {
//             if (this.showPicker) {
//                 this.showPicker(); // Force date picker to open
//                 console.log("Date picker triggered.");
//             } else {
//                 console.log("showPicker() not supported in this browser.");
//             }
//         });
//     } else {
//         console.log("DOB input field not found!");
//     }
// });

$(document).ready(function() {
    $("#dob").datepicker({
        format: "yyyy-mm-dd",  // Change format as needed
        autoclose: true,
        todayHighlight: true,
        endDate: "0d"          // Prevent future dates
    });
});


// Validation Function
function validateRegistrationForm() {
    clearErrors(); // Clear previous errors

    let isValid = true; // Assume form is valid

    let firstName = document.getElementById('first_name').value.trim();
    let lastName = document.getElementById('last_name').value.trim();
    let email = document.getElementById('email').value.trim();
    let city = document.getElementById('city').value.trim();
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirm_password').value;
    let mobileNo = document.getElementById('mobile_no').value.trim();
    let dob = document.getElementById('dob').value.trim();

    // Name ...
    let nameRegex = /^[A-Za-z]+$/;
    if (!firstName) {
        showError('first_name', 'First Name is required.');
        isValid = false;
    } else if (!nameRegex.test(firstName)) {
        showError('first_name', 'First Name should only contain alphabets.');
        isValid = false;
    }

    if (!lastName) {
        showError('last_name', 'Last Name is required.');
        isValid = false;
    } else if (!nameRegex.test(lastName)) {
        showError('last_name', 'Last Name should only contain alphabets.');
        isValid = false;
    }

    // Email ...
    let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!email) {
        showError('email', 'Email is required.');
        isValid = false;
    } else if (!emailRegex.test(email)) {
        showError('email', 'Enter a valid email address.');
        isValid = false;
    }

    // City ...
    let cityRegex = /^[A-Za-z]+$/;
    if (!city) {
        showError('city', 'City is required.');
        isValid = false;
    } else if (!cityRegex.test(city)) {
        showError('city', 'City Name should only contain alphabets.');
        isValid = false;
    }

    // Mobile ...
    let phoneRegex = /^[0-9]{10}$/;
    if (!mobileNo) {
        showError('mobile_no', 'Mobile number is required.');
        isValid = false;
    } else if (!phoneRegex.test(mobileNo)) {
        showError('mobile_no', 'Mobile no. should only contain numbers and be exactly of 10 digits.');
        isValid = false;
    }

    // Date of Birth ....
    let currentDate = new Date();
    let dobDate = new Date(dob);
    if (!dob || isNaN(dobDate.getTime())) {
        showError('dob', 'Please select a valid Date of Birth.');
        isValid = false;
    } else if (dobDate >= currentDate) {
        showError('dob', 'Date of Birth must be less than the current date.');
        isValid = false;
    }

    //  Password ...
    let passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!password) {
        showError('password', 'Password is required.');
        isValid = false;
    } else if (!passwordRegex.test(password)) {
        showError('password', 'Password must be at least 8 characters, contain 1 uppercase, 1 number, and 1 special character.');
        isValid = false;
    }

    //  Confirm Password ...
    if (password !== confirmPassword) {
        showError('confirm_password', 'Passwords do not match.');
        isValid = false;
    }

    return isValid; // Return true if valid, false otherwise
}

// Show Error Message Next to Field
function showError(fieldId, message) {
    let field = document.getElementById(fieldId);
    let errorElement = document.createElement("span");

    errorElement.classList.add("error");
    errorElement.textContent = message;

    // Remove previous error message if exists
    let existingError = field.parentNode.querySelector(".error");
    if (existingError) {
        existingError.remove();
    }

    field.parentNode.appendChild(errorElement);
}

function validateLoginForm()
{
    clearErrors(); // Clear previous errors

    let isValid = true; // Assume form is valid

    let email = document.getElementById('email').value.trim();
    let password =  document.getElementById('password').value.trim();
   
    let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!email) {
        showError('email', 'Email is required.');
        isValid = false;
    } else if (!emailRegex.test(email)) {
        showError('email', 'Enter a valid email address.');
        isValid = false;
    }

    let passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!password) {
        showError('password', 'Password is required.');
        isValid = false;
    } else if (!passwordRegex.test(password)) {
        showError('password', 'Password must be at least 8 characters, contain 1 uppercase, 1 number, and 1 special character.');
        isValid = false;
    }
    return isValid; // Return true if valid, false otherwise
}



// Clear All Previous Errors
function clearErrors() {
    let errorElements = document.querySelectorAll('.error');
    errorElements.forEach(function (element) {
        element.remove(); // Remove all existing error messages
    });
}
