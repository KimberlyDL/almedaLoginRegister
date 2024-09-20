<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>User List</h2>

            <!-- Create User Button -->
            <a href="/user/create" class="btn btn-primary">Create User</a>
        </div>

        <!-- DataTable -->
        <table id="usersTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['knidl_last_name'] ?></td>
                        <td><?= $user['knidl_first_name'] ?></td>
                        <td><?= $user['knidl_email'] ?></td>
                        <td><?= $user['knidl_gender'] ?></td>
                        <td><?= $user['knidl_address'] ?></td>
                        <td>
                            <a href="/user/<?= $user['id'] ?>" class="btn btn-sm btn-success">View</a>
                            <a href="/user/edit/<?= $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/user/delete/<?= $user['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable();
        });
    </script>


</body>

</html>