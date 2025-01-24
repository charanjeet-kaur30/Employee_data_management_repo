<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="profile">
        <div class="container">
        <div class="d-flex justify-content-end">
        <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    <h1>All Employees</h1>
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Employees Detail</h5>
        <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>City</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php if (!empty($employees)): ?>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee->id ?></td>
            <td><?php echo $employee->first_name ?></td>
            <td><?php echo $employee->last_name ?></td>
            <td><?php echo $employee->email ?></td>
            <td><?php echo $employee->city ?></td>
            <td><?php echo $employee->mobile_no ?></td>
            <td>
                <select class="form-control" id="status_<?php echo $user->id ?>" onchange="updateStatus(<?= $employee->id ?>)">
                    <option value="active" <?= ($employee->status == 'active') ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= ($employee->status == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                </select>
            </td>
            <td><button class="btn btn-primary" onclick="updateStatus(<?= $employee->id ?>)">Update Status</button></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No employees found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

<script>
function updateStatus(employeeId) {
    var status = document.getElementById('status_' + employeeId).value;
    
    if (confirm('Are you sure you want to update the status?')) {
        window.location.href = '<?= base_url("admin/update_employee_status/") ?>' + employeeId + '/' + status;
    }
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
