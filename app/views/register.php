<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .gradient-custom-3 {
            background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
        }

        .gradient-custom-4 {
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
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                <form action="<?= site_url('register'); ?>" method="post"
                                    onsubmit="return validatePassword();">

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" />
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                                            required />
                                        
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg" minlength="8" required />
                                            <!-- <button type="button" id="togglePassword" class="input-group-text">
                                                <i class="fas fa-eye" id="passwordToggleIcon"></i>
                                            </button> -->
                                        </div>
                                        <p id="passwordErrorMessage" style="color: red;"></p>
                                        <div class="form-text">Password must be at least 8 characters long and contain
                                            at least 1 numeric character.</div>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="passwordConfirm">Confirm password</label>
                                        <div class="input-group mb-3">
                                        <input type="password" id="passwordConfirm" name="passwordConfirm"
                                            class="form-control form-control-lg" required />
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="login"
                                            class="fw-bold text-body"><u>Login here</u></a></p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script>
        document.getElementById("togglePassword").addEventListener("click", togglePasswordVisibility);

        function validatePassword() {
            const passwordInput = document.getElementById("password");
            const password = passwordInput.value;

            const numberRegex = /[0-9]/;

            if (password.length >= 8 && numberRegex.test(password)) {
                document.getElementById("passwordErrorMessage").textContent = "";
                return true;
            } else {
                document.getElementById("passwordErrorMessage").textContent =
                    "Password must be at least 8 characters long and contain at least 1 numeric character.";
                return false; // Prevent form submission
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const passwordToggleIcon = document.getElementById("passwordToggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggleIcon.classList.remove("fa-eye");
                passwordToggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                passwordToggleIcon.classList.remove("fa-eye-slash");
                passwordToggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>