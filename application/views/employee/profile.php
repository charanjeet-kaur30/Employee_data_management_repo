<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="body">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
        <h1>Manage Your Profile</h1>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<form action="<?php echo site_url('EmployeeController/update_profile'); ?>" method="post">
    <div class="form-group mb-3">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name', $user['first_name']); ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name', $user['last_name']); ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', $user['email']); ?>" required>
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="<?php echo site_url('EmployeeController/delete_profile'); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">Delete Profile</a>
    </div>
</form>

<a href="<?php echo site_url('employee/dashboard'); ?>" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
