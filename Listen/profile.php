<?php session_start(); ?>
<?php include 'includes/header.php'; ?>

<body onload="editProfile();">

    <?php include 'includes/modal.php'; ?>

    <?php include 'includes/loader.php'; ?>

    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>

        <?php include 'includes/searchbar.php'; ?>


        <main id="page_content">
            <div class="hero" style="background-image: url(images/banner/event.jpg);"></div>
            <div class="under-hero container">

                <div class="top-0 start-0 translate-middle-y" style="z-index: 11">
                    <div id="myToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body" id="mess">
                                <!-- Hello, world! This is a toast message. -->
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="plan bg-light">
                        <div class="plan__data">
                            <div class="px-4 pt-2 pe-xl-0 pt-sm-0 mt-4 mb-3 my-sm-0 w-100">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar avatar--xl">
                                        <div class="avatar__image">
                                            <img src="images/users/thumb.jpg" alt="user" id="mainProfile">
                                        </div>
                                    </div>
                                    <div class="ps-3">
                                        <input type="file" id="profile" class="d-none" name="profilePic">
                                        <label for="profile" class="btn btn-default rounded-pill">Change image</label>
                                        <input type="hidden" name="oldPic" id="oldPic">
                                    </div>
                                </div>
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <label for="f_name" class="form-label fw-medium">First name</label>
                                        <input type="text" id="f_name" class="form-control" name="firstName">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="l_name" class="form-label fw-medium">Last name</label>
                                        <input type="text" id="l_name" class="form-control" name="lastName">
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" onclick="saveUserEditDetail();">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer id="footer">
                <div class="container">
                    <div class="text-center mb-4"><a href="mailto:info@listenapp.com" class="display-5 email">ebizon@listenapp.com</a></div>
                </div>
            </footer>
        </main>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>