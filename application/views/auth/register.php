<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="register">

    <div class="container">
        <h2 class="text-center">Registration Form</h2>
        <p class="text-center">Please fill in the details below to register.</p>
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <form method="POST" action="<?php echo site_url('AuthController/register_user'); ?>"> 
        <input type="hidden" name="role" value="<?php echo isset($role_id) ? $role_id : ''; ?>">  <!-- Hidden role field -->    

            <!-- Username -->
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

             <!-- employee code -->
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>

            <div class="mb-3">
                <label for="mobile_no" class="form-label">Mobile No.:</label>
                <input type="text" class="form-control" id="mobile_no" name="mobile_no" required>
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">D.O.B:</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <!--  Role selection -->
             <div class="mb-3">
                <label for="role_id" class="form-label">Role:</label>
                <select class="form-control" id="role_id" name="role_id" required>
                    <option>Select-Role</option>
                    <option value="1" <?php echo (isset($role_id) && $role_id == 1) ? 'selected' : ''; ?>>Admin</option>
                    <option value="2" <?php echo (isset($role_id) && $role_id == 2) ? 'selected' : ''; ?>>Employee</option>
                </select>
            </div>

            <div class="clear"></div>
            <!-- Submit Button -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Register</button>
            </div>

            <p class="mt-3 text-center">Already have an account? <a href="<?php echo site_url('AuthController/login_user'); ?>">Login here</a></p>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
