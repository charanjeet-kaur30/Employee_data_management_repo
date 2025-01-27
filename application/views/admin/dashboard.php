<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="body">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">

            <a class="navbar-brand" href="<?php echo base_url('AdminController/dashboard')?>">
            <img src="<?php echo base_url('assets/imgs/dashboards.png'); ?>" alt="Logo" width="30" height="30" class="d-inline-block align-top">
            Admin Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                <img src="<?= base_url('assets/imgs/user.png'); ?>" alt="Logo" width="32" height="35" class="d-inline-block align-top">  
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/profile')?>">Profile</a></li>
                <img src="<?php echo base_url('assets/imgs/logout.png'); ?>" alt="Logo" width="32" height="35" class="d-inline-block align-top">    
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('AuthController/logout')?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard Content -->
    <div class="container mt-5">
        <h1 class="mb-4">Welcome, <?php if(isset($user['first_name']) && isset($user['last_name'])) 
        {
               echo $user['first_name'] . ' ' . $user['last_name'];
        }
        else
        {
            echo "Admin";
        }
        ?>!</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                    <img src="<?php echo base_url('assets/imgs/profile.png'); ?>" alt="Logo" width="32" height="35" class="d-inline-block align-top">  
                        <h5 class="card-title">Employee Management</h5>
                        <p class="card-text">View and manage employee records.</p>
                        <a href="<?php echo site_url('admin/employee_management')?>" class="btn btn-light">Manage Employees</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                    <img src="<?php echo base_url('assets/imgs/report.png'); ?>" alt="Logo" width="32" height="35" class="d-inline-block align-top">  
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text">Generate and review system reports.</p>
                        <a href="<?php echo site_url('admin/reports')?>" class="btn btn-light">View Reports</a>
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
