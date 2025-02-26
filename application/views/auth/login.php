<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
       .error {
        color: red;
        font-size: 0.875em;
        display: block;
        margin-top: 5px;
            }
    </style>
</head>
<body class="login">

    <div class="container">

    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url('HomeController/index'); ?>" class="btn btn-secondary">Back to Home</a>
    </div>

    <div class="clear"></div>

    <?php if (!isset($role)): ?>
    <!-- Use $role variable safely -->   
     <p class="bg-success"><i>Logged in as: 
        <?= htmlspecialchars($this->session->userdata('role_id') == 1 ? 'Admin' : 'Employee'); ?></i>
    </p>
    <?php else: ?>
          <p>Role not specified.</p>
    <?php endif; ?>

        <h2 class="text-center">Login Form</h2>
        <p class="text-center">Please enter your credentials to login.</p>

        <form method="POST" id="login_form" onclick="return validateLoginForm()" action="<?php echo site_url('AuthController/login_user/'.$role_id); ?>" id="form">
            <!-- Email -->
            <div>
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo get_cookie('email'); ?>"  required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo get_cookie('password')?>" required>
            </div>
<<<<<<< HEAD
            
            <div class="clear"></div>
=======
>>>>>>> 9968d61c42698dbee426e1bea50aa70b3b596bd7

            <!-- Remember Me Checkbox -->
            <div>
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember_me">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>

<div class="clear"></div>

                <!-- Hidden Role Input Field -->
            <input type="hidden" name="role" value="<?php echo $role_id; ?>">

            <!-- Submit Button -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>

            <p class="mt-3 text-center">Don't have an account? <a href="<?php echo site_url('AuthController/register_user'); ?>">Register here</a></p>
            
             <!-- Forgot Password Link -->
             <p class="mt-2 text-center"><a href="<?php echo site_url('AuthController/forgot_password'); ?>">Forgot Password?</a></p>
        </form>
    </div>
  <script>
      document.addEventListener("DOMContentLoaded", function()
         {
            console.log('logged in');
           document.querySelector("#form").reset(); // Clears all form fields
         });
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/js/form_validations.js')?>"></script>
</body>
</html>
