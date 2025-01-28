function validateRegistrationForm() {
    const firstName = document.getElementById('first_name').value.trim();
    const lastName = document.getElementById('last_name').value.trim();
    const email = document.getElementById('email').value.trim();
    const city = document.getElementById('city').value.trim();
    const mobileNo = document.getElementById('mobile_no').value.trim();
    const dob = document.getElementById('dob').value;
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirm_password').value.trim();
    const currentDate = new Date();

    // Name Validation (only alphabets allowed)
    const nameRegex = /^[A-Za-z]+$/;
    if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
        alert('First and Last Name should only contain alphabets.');
        return false;
    }

    // Email Validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    const cityRegex = /^[A-Za-z]+$/;
    if (!nameRegex.test(city)) {
        alert('city should only contain alphabets.');
        return false;
    }

    // Phone Number Validation (only numbers, length 10)
    const phoneRegex = /^[0-9]{10}$/;
    if (!phoneRegex.test(mobileNo)) {
        alert('Mobile Number must be a 10-digit number.');
        return false;
    }

    // Date of Birth Validation (should be less than current date)
    const dobDate = new Date(dob);
    // Check if the date is valid and is not in the future
    if (dobDate > currentDate) {
        alert('Date of Birth must be less than the current date.');
        return false;
    }

    // Password Validation (at least 8 characters, 1 uppercase letter, 1 number, 1 special character)
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;
    if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters long, include 1 uppercase letter, 1 number, and 1 special character.');
        return false;
    }

    // Confirm Password Validation
    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true; // All validations passed
}


function validateLoginForm() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    // Email Validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    // Password Validation (at least 8 characters, 1 uppercase letter, 1 number, 1 special character)
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;
    if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters long, include 1 uppercase letter, 1 number, and 1 special character.');
        return false;
    }

    return true; // All validations passed
}