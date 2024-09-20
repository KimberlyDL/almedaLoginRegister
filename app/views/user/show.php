<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">User Details</h2>

                <!-- Display user details as text -->
                <div class="mb-3">
                    <label class="form-label"><strong>First Name:</strong></label>
                    <p><?= htmlspecialchars($user['knidl_first_name']) ?></p>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Last Name:</strong></label>
                    <p><?= htmlspecialchars($user['knidl_last_name']) ?></p>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Email:</strong></label>
                    <p><?= htmlspecialchars($user['knidl_email']) ?></p>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Gender:</strong></label>
                    <p><?= htmlspecialchars($user['knidl_gender']) ?></p>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Address:</strong></label>
                    <p><?= htmlspecialchars($user['knidl_address']) ?></p>
                </div>

                <div class="d-grid gap-2">
                    <a href="/user/edit/<?= htmlspecialchars($user['id']) ?>" class="btn btn-primary">Edit User</a>
                    <a href="/user/delete/<?= htmlspecialchars($user['id']) ?>" class="btn btn-sm btn-danger">Delete</a>

                    <a href="/" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
