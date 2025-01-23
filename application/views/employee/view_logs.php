<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Logs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">

    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url('employee/dashboard'); ?>" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    
    <h1>All Logs</h1>

   

<!-- Flash Messages -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>


    <!-- Add Log Button -->
    <a href="<?php echo base_url('employee/add_logs'); ?>" class="btn btn-primary">Add New Log</a>
    
    <!-- Display Logs -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Log Description</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($logs)): ?>
            <?php foreach ($logs as $index => $log): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $log['log_content']; ?></td>
                    <td><?php echo $log['log_date']; ?></td>
                    <td><?php echo $log['start_time_only']; ?></td>
                    <td><?php echo $log['end_time_only']; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="4">No logs found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
