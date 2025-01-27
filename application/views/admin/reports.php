<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        
    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-secondary">Back to Dashboard</a>
    </div>

        <h1 class="mb-4">Reports</h1>

        <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

        <!-- Add Report Form -->
        <div class="mb-5">
            <a href="<?php echo site_url('admin/add_report')?>">
                <button type="submit" class="btn btn-primary">Add Report</button>
            </a>
        </div>

        <!-- List of Reports -->
        <h4>Existing Reports</h4>
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reports)) : ?>
                    <?php foreach ($reports as $index => $report) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $report['title']; ?></td>
                            <td><?php echo $report['description']; ?></td>
                            <td><?php echo $report['date']; ?></td>
                            <td>
                                <a href="<?php echo site_url('AdminController/delete_report/'.$report['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                <a href="<?php echo site_url('AdminController/download_report/'.$report['id']); ?>" class="btn btn-success btn-sm">Download</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">No reports available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
