<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Form</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .gradient-custom-3 {
            /* fallback for old browsers */
            background: #84fab0;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
        }

        .gradient-custom-4 {
            /* fallback for old browsers */
            background: #84fab0;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
        }
    </style>
</head>

<body>
    <section class="vh-100 bg-image"
        style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Send to Email</h2>
                                <div class="text-center">

                                    <?php if (isset($errors)): ?>
                                        <?php foreach ($errors as $error): ?>
                                            <?= $error ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <p class="lead">Try sending a file to your email.</p>
                                    <form action="<?php echo site_url('upload'); ?>" method="post"
                                        enctype="multipart/form-data">
                                        <input type="text" name="name" class="form-control mb-3"
                                            placeholder="Sender name" />
                                        <input type="email" name="email" class="form-control mb-3"
                                            placeholder="Recepient's email" />
                                        <input type="text" name="subject" class="form-control mb-3"
                                            placeholder="Subject" />
                                        <input type="textarea" name="content" class="form-control mb-3"
                                            placeholder="Body" />
                                        <input type="file" name="userfile" class="form-control mb-3"
                                            accept="image/png, image/gif, image/jpeg" />
                                        <input type="submit" value="Upload" class="btn btn-primary" />
                                    </form><br>
                                    <a href="/logout" class="btn btn-danger">Logout</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Bootstrap JS and Popper.js links (required for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>