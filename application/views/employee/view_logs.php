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
<div class="container mt-5">
    <h1>Your Logs</h1>
    
    <!-- Add Log Button -->
    <a href="<?php echo base_url('EmployeeController/add_log'); ?>" class="btn btn-primary">Add New Log</a>
    
    <!-- Display Logs -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Log Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?php echo $log['log_date']; ?></td>
                    <td><?php echo $log['log_description']; ?></td>
                    <td>
                        <a href="<?php echo base_url('EmployeeController/edit_log/' . $log['id']); ?>" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a> <!-- Implement Delete logic -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
