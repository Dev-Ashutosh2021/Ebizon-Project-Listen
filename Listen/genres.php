<?php session_start(); ?>
<?php include 'includes/header.php'; ?>

<body onload="genres()">

    <?php include 'includes/modal.php'; ?>

    <?php include 'includes/loader.php'; ?>

    <div id="wrapper">
        <?php include 'includes/sidebar.php'; ?>

        <?php include 'includes/searchbar.php'; ?>

        <main id="page_content">
            <div class="hero" style="background-image: url(images/banner/home.jpg);"></div>
            <div class="under-hero container">
                <div class="section">
                    <div class="section__head">
                        <h3 class="mb-0">Music <span class="text-primary">Genres</span></h3>
                    </div>
                    <div class="row g-4" id="genre-div">

                        <!-- <div class="col-xl-3 col-sm-6">
                            <div class="cover cover--round"><a href="genre-details.html" class="cover__image"><img
                                        src="images/background/horizontal/2.jpg" alt="Rock">
                                    <div class="cover__image__content"><span
                                            class="cover__title mb-1 fs-6 text-truncate">Rock</span></div>
                                </a></div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="cover cover--round"><a href="genre-details.html" class="cover__image"><img
                                        src="images/background/horizontal/3.jpg" alt="Sufi">
                                    <div class="cover__image__content"><span
                                            class="cover__title mb-1 fs-6 text-truncate">Sufi</span></div>
                                </a></div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="cover cover--round"><a href="genre-details.html" class="cover__image"><img
                                        src="images/background/horizontal/4.jpg" alt="Romantic">
                                    <div class="cover__image__content"><span
                                            class="cover__title mb-1 fs-6 text-truncate">Romantic</span>
                                    </div>
                                </a></div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="cover cover--round"><a href="genre-details.html" class="cover__image"><img
                                        src="images/background/horizontal/5.jpg" alt="Sports">
                                    <div class="cover__image__content"><span
                                            class="cover__title mb-1 fs-6 text-truncate">Sports</span>
                                    </div>
                                </a></div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="cover cover--round"><a href="genre-details.html" class="cover__image"><img
                                        src="images/background/horizontal/6.jpg" alt="Retro">
                                    <div class="cover__image__content"><span
                                            class="cover__title mb-1 fs-6 text-truncate">Retro</span></div>
                                </a></div>
                        </div> -->
                    </div>
                </div>
                <!-- <div class="section">
                                <div class="section__head">
                                    <h3 class="mb-0">Podcast <span class="text-primary">Genres</span></h3>
                                </div>
                                <div class="row g-4">
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="cover cover--round"><a href="genre-details.html" class="cover__image"><img
                                                    src="images/background/horizontal/3.jpg" alt="Stories">
                                                <div class="cover__image__content"><span
                                                        class="cover__title mb-1 fs-6 text-truncate">Stories</span></div>
                                            </a></div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="cover cover--round"><a href="genre-details.html" class="cover__image"><img
                                                    src="images/background/horizontal/5.jpg" alt="Meditation & Workout">
                                                <div class="cover__image__content"><span
                                                        class="cover__title mb-1 fs-6 text-truncate">Meditation & Workout</span>
                                                </div>
                                            </a></div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="cover cover--round"><a href="genre-details.html" class="cover__image"><img
                                                    src="images/background/horizontal/6.jpg" alt="Business">
                                                <div class="cover__image__content"><span
                                                        class="cover__title mb-1 fs-6 text-truncate">Business</span></div>
                                            </a></div>
                                    </div>
                                </div>
                            </div> -->
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