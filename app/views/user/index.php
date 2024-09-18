<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GADREEL</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #19191a;
            color: white;
        }

        input.form-control {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row align-items-center d-flex"> <!-- Center align content vertically -->
            <div class="col-md-5">
                <table class="table table-bordered">
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Last name</th>
                            <th scope="col">First name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-dark">
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['knidl_last_name'] ?></td>
                                <td><?= $user['knidl_first_name'] ?></td>
                                <td><?= $user['knidl_email'] ?></td>
                                <td><?= $user['knidl_gender'] ?></td>
                                <td><?= $user['knidl_address'] ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= site_url('edit/' . $user['id']); ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                        <form action="<?= site_url('delete'); ?>" method="post">
                                            <input type="hidden" id="id" name="id" value="<?= $user['id'] ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>