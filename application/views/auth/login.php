<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="login">

    <div class="container">
        <h2 class="text-center">Login Form</h2>
        <p class="text-center">Please enter your credentials to login.</p>

        <form method="POST" action="<?php echo site_url('AuthController/login_user'); ?>" id="form">
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
            
            <div class="clear"></div>

            <!-- Remember Me Checkbox -->
            <div>
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember_me">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>

<div class="clear"></div>

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
  
</body>
</html>
