<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee Logs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Add a New Log</h1>
    
    <?php echo form_open('EmployeeController/add_logs'); ?>
        <div class="form-group">
            <label for="log_content">Log Description</label>
            <textarea name="log_content" class="form-control" id="log_content" rows="4" required></textarea>
            <div class="text-danger"><?php echo form_error('log_content'); ?></div>
        </div>

        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" name="start_time" class="form-control" id="start_time" value="<?php echo set_value('start_time'); ?>" required>
            <div class="text-danger"><?php echo form_error('start_time'); ?></div>        
        </div>

        <div class="form-group">
            <label for="end_time">End Time (8 hours shift)</label>
            <input type="time" name="end_time" class="form-control" id="end_time" value="<?php echo set_value('end_time'); ?>" required>
            <div class="text-danger"><?php echo form_error('end_time'); ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Save Log</button>
    <?php echo form_close(); ?>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
