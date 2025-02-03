<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="body">
    <div class="container">     
         
            <div class="d-flex justify-content-end">
            <a href="<?php echo base_url('admin/profile'); ?>" class="btn btn-secondary">Back to Profile</a>
            </div>
            <img src="<?php echo base_url('assets/imgs/edit-profile.png'); ?>" alt="Logo" width="50" height="50" class="d-inline-block align-top">
            <h1 img src="<?php echo base_url('assets/imgs/edit-profile.png'); ?>" alt="Logo" width="50" height="50" class="d-inline-block align-top">Edit Profile</h1>    

        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <!-- Form Start -->
        <form action="<?php echo base_url('AdminController/update_profile'); ?>" method="post">
            <div class="form-group mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" 
                    value="<?php echo $user['first_name']; ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" 
                    value="<?php echo $user['last_name']; ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                    value="<?php echo $user['email']; ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="mobile_no" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobile_no" name="mobile_no" 
                    value="<?php echo $user['mobile_no']; ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" 
                    value="<?php echo $user['city']; ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" 
                    value="<?php echo $user['dob']; ?>" required>
            </div>

   <!-- Profile Image Upload -->

   <div class="form-group mb-3">
               <label for="profile_image" class="form-label">Upload Profile Image</label>
               <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
               </div> 
<div class="clear"></div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
        <!-- Form End -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
