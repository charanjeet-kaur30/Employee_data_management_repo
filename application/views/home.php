<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data Management</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="body">

    <!-- Navbar with Logo -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('assets/imgs/logo.png'); ?>" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Employee Data Management
            </a>

            <!-- Navbar Toggler Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('about')?>"><b>About Us</b></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container mt-5">
        <h1 class="text-center">Welcome to Employee Data Management</h1>
        <p class="text-center">Please choose an option to proceed further..</p>

        <div class="row justify-content-center mt-5">
            <!-- Employee Section -->
            <div class="col-md-5 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Employee</h4>
                    </div>
                    <div class="card-body text-center">
                        <a href="<?php echo site_url('EmployeeController/register')?>" class="btn btn-success btn-lg mb-3">Register as Employee</a>
                        <br>
                        <a href="<?php echo site_url('EmployeeController/login')?>" class="btn btn-primary btn-lg">Login as Employee</a>
                    </div>
                </div>
            </div>

            <!-- Admin Section -->
            <div class="col-md-5 mb-4">
                <div class="card">
                    <div class="card-header bg-danger text-white text-center">
                        <h4>Admin</h4>
                    </div>
                    <div class="card-body text-center">
                        <a href="<?php echo site_url('AdminController/register')?>" class="btn btn-success btn-lg mb-3">Register as Admin</a>
                        <br>
                        <a href="<?php echo site_url('AdminController/login')?>" class="btn btn-danger btn-lg">Login as Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
    <p>&copy; 2025 Employee Data Management. All Rights Reserved.</p>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>
</html>