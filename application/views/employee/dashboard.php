<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="body">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('EmployeeController/dashboard')?>">Employee Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('AuthController/logout')?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard Content -->
    <div class="container mt-5">
        <h1 class="mb-4">Welcome, Employee!</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Your Profile</h5>
                        <p class="card-text">View and update your personal information.</p>
                        <a href="#" class="btn btn-light">Manage Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Your Logs</h5>
                        <p class="card-text">Add your daily logs.</p>
                        <a href="#" class="btn btn-light">Add Logs</a>
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
