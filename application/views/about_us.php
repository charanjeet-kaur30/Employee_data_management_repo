<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Employee Data Management</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="body">
 
    <!-- Navbar with Logo -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="<?php echo base_url('assets/imgs/logo.png'); ?>" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Employee Data Management
            </a>


            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('HomeController/index'); ?>"><b>Home</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('HomeController/about')?>"><b>About Us</b></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- About Us Section -->
    <div class="container mt-5">
        <h1 class="text-center">About Us</h1>
        <p class="text-center">Welcome to Employee Data Management System.</p>


        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <h4>Our Mission</h4>
                <p>
                    Our mission is to provide an efficient and user-friendly platform for managing employee data.
                    Additionally we also aim to simplify the process of managing employee records, tracking performance, and handling administrative tasks
                    along with providing enhanced security ensured to users.
                    
                </p>
                <h4>Our Vision</h4>
                <p>
                    We envision becoming the leading platform for employee management by integrating advanced features and promoting simplicity in design.
                </p>
            </div>
        </div>
    </div>


    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p>&copy; 2025 Employee Data Management. All Rights Reserved.</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
