<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Logs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
<h2>Edit Log</h2>
<form action="<?php echo site_url('EmployeeController/update_log/' . $log['id']); ?>" method="post">
    <label for="log_content">Log Content:</label>
    <textarea name="log_content" id="log_content" rows="4"><?php echo set_value('log_content', $log['log_content']); ?></textarea>

    <label for="start_time">Start Time:</label>
    <input type="datetime-local" name="start_time" id="start_time" value="<?php echo set_value('start_time', $log['start_time']); ?>">

    <label for="end_time">End Time:</label>
    <input type="datetime-local" name="end_time" id="end_time" value="<?php echo set_value('end_time', $log['end_time']); ?>">

    <button type="submit">Update Log</button>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
