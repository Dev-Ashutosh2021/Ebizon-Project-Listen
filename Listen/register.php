<?php include 'includes/header.php'; ?>

<body>

    <?php include 'includes/loader.php'; ?>

    <div id="wrapper">
        <div class="auth py-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-9 col-sm-11 mx-auto">
                        <div class="position-relative container">
                            <!-- Your content here -->
                            <div class="position-absolute top-0 start-0" style="z-index: 11">
                                <div id="myToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        <div class="toast-body" id="mess">
                                            <!-- Hello, world! This is a toast message. -->
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-sm-5">
                                <h4>
                                    Register with <span class="text-primary">Listen</span>
                                </h4>
                                <p class="fs-6">
                                    It's time to join with Listen and gain full awesome music
                                    experience.
                                </p>
                                <form class="mt-5 needs-validation" id="registerForm" novalidate>
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-medium">Email</label>
                                        <input type="email" id="email" class="form-control" name="email" required />
                                        <div class="invalid-feedback">Please enter a valid email address.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="first-name" class="form-label fw-medium">First Name</label>
                                        <input type="text" id="first-name" class="form-control" name="firstName" required />
                                        <div class="invalid-feedback">Please enter your first name.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last-name" class="form-label fw-medium">Last Name</label>
                                        <input type="text" id="last-name" class="form-control" name="lastName" required />
                                        <div class="invalid-feedback">Please enter your last name.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-medium">Password</label>
                                        <input type="password" id="password" class="form-control" name="password" required />
                                        <div class="invalid-feedback">Please enter a password.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="c_password" class="form-label fw-medium">Confirm Password</label>
                                        <input type="password" id="c_password" class="form-control" name="confirmPassword" required />
                                        <div class="invalid-feedback">Please confirm your password.</div>
                                    </div>
                                    <div class="mb-5 mt-5">
                                        <input type="button" class="btn btn-primary w-100" value="Register" onclick="register()" />
                                    </div>
                                    <p>
                                        Do you have an Account?<br /><a href="login.php" class="fw-medium external">Login</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/plugins.bundle.js"></script>
    <script src="js/scripts.bundle.js"></script>
    <script src="js/script.js"></script>
</body>

</html>