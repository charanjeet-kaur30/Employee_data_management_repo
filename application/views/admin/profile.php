<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="profile">
        <div class="container">
        <div class="d-flex justify-content-end">
        <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    
      <!-- Display User Profile Image or Default Image -->
     <?php if (!empty($user['profile_image'])): ?>
    <img src="<?php echo base_url($user['profile_image']); ?>" 
         alt="Profile Image" width="100" height="100" class="rounded-circle">
<?php else: ?>
    <img src="<?php echo base_url('assets/imgs/user.png'); ?>" 
         alt="Default Profile Image" width="100" height="100" class="rounded-circle">
<?php endif; ?>

        <h1 img src="<?php echo base_url('assets/imgs/user.png'); ?>" alt="Logo" width="50" height="50" class="d-inline-block align-top" class="profile" >Your Profile</h1>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Profile Details</h5>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td><?php echo $user['id']; ?></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td><?php echo $user['first_name']; ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?php echo $user['last_name']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $user['email']; ?></td>
                </tr>
                <tr>
                    <th>City</th>
                    <td><?php echo $user['city']; ?></td>
                </tr>
                <tr>
                    <th>Mobile Number</th>
                    <td><?php echo $user['mobile_no']; ?></td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td><?php echo $user['dob']; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo ucfirst($user['status']); ?></td>
                </tr>           
            </tbody>
        </table>
    </div>
</div>

<!-- Navigation Buttons -->
<div class="mt-4">
    <a href="<?php echo site_url('admin/edit_profile'); ?>" class="btn btn-primary">Edit Profile</a>
</div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
