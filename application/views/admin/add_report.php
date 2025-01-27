<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Report</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="body">

    <!-- Add Report Form -->
    <div class="container mt-5">

    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url('admin/reports'); ?>" class="btn btn-secondary">Back</a>
    </div>
        <h1 class="mb-4">Add New Report</h1>

        <?php if ($this->session->flashdata('success')): ?>
             <div class="alert alert-success">
               <?php echo $this->session->flashdata('success'); ?>
             </div>
        <?php endif; ?>

        <form action="<?php echo site_url('AdminController/add_report'); ?>" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="clear"></div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="clear"></div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="datetime-local" class="form-control" id="date" name="date" required>
            </div>
            <div class="clear"></div>
            <button type="submit" class="btn btn-primary">Add Report</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
