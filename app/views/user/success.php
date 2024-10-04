<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

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
    <?php if (!empty($_SESSION['errors'])): ?>
        <div class="alert alert-danger" role="alert">
            <strong class="font-weight-bold">Successs!</strong>
            <span class="d-block">
                <?php
                $errorMessages = is_array($_SESSION['errors']) ? $_SESSION['errors'] : [$_SESSION['errors']];
                echo implode('<br>', $errorMessages);
                ?>
            </span>
        </div>
    <?php endif; ?>
    <div class="container mt-4">
        <div class="row align-items-center d-flex"> <!-- Center align content vertically -->
            <div>Success</div>
        </div>
    </div>
</body>

</html>