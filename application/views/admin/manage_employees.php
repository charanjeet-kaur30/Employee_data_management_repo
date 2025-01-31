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

   <!-- Filter Form -->
   <form method="get" action="<?php echo base_url('AdminController/manage_employees'); ?>" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="number" name="user_id" class="form-control" placeholder="Filter by User ID" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            </div>
            <div class="col-md-3">
                <select name="department_id" class="form-control">
                    <option value="">Select Department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?php echo $department['id']; ?>" <?php echo isset($department_id) && $department_id == $department['id'] ? 'selected' : ''; ?>>
                            <?php echo $department['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </form>


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
        <?php foreach ($employees as $index => $employee): ?>
        <tr>
            <td><?php echo $index + 1 ?></td>
            <td><?php echo $employee['first_name']; ?></td>
            <td><?php echo $employee['last_name']; ?></td>
            <td><?php echo $employee['email']; ?></td>
            <td><?php echo $employee['city']; ?></td>
            <td><?php echo $employee['mobile_no']; ?></td>
            <td>
                <select class="form-control" id="status_<?php echo $employee['id'];?>" onchange="updateStatus(<?php echo $employee['id']; ?>)">
                    <option value="active" <?php echo ($employee['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?php echo ($employee['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                </select>
            </td>
            <td><button class="btn btn-primary" onclick="updateStatus(<?php echo $employee['id']; ?>)">Update Status</button></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No employees found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

    <!-- Pagination links -->
    <div class="pagination-wrapper">
    <?php 
    // Check if $pagination is set before echoing
    if (isset($pagination)) {
        echo $pagination;
    } else {
        echo 'No pagination available';
    }
?>
    </div>

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
