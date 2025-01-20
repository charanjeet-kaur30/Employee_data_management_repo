<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <form method="POST" action="<?php echo site_url('AuthController/forgot_password'); ?>">

            <div>
                <label for="email" class="form-label">Enter Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
  
<div class="clear"></div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
            </div>
       </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
