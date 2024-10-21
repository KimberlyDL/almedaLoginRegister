<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Update User</h2>

                <!-- User update form -->
                <form action="/user/update/<?= htmlspecialchars($user['id']) ?>" method="POST">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <!-- Populate the first name field -->
                        <input type="text" class="form-control" id="firstName" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <!-- Populate the last name field -->
                        <input type="text" class="form-control" id="lastName" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <!-- Populate the email field -->
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <!-- Populate the gender field -->
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="Male" <?= $user['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= $user['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= $user['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <!-- Populate the address field -->
                        <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Update User</button>
                        <a href="/" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

