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
        <form method="POST" action="<?php echo site_url('LoginController/update_password'); ?>">

            <div>
            <input type="hidden" name="token" value="<?= $token; ?>">
            <label for="password">New Password</label>
            <input type="password" name="password" required>

    <div class="clear"></div>

            <button type="submit">Update Password</button>
            </div>      
       </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
