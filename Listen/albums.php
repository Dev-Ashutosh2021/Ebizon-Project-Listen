<?php session_start(); ?>
<?php include 'includes/header.php'; ?>

<body onload="albums()">

    <?php include 'includes/modal.php'; ?>

    <?php include 'includes/loader.php'; ?>

    <div id="wrapper">
        <?php include 'includes/sidebar.php'; ?>

        <?php include 'includes/searchbar.php'; ?>

        <main id="page_content">
            <div class="hero" style="background-image: url(images/banner/song.jpg);"></div>
            <div class="under-hero container">
                <div class="section">
                    <div class="section__head align-items-center"><span class="d-block pe-3 fs-6 fw-semi-bold" id="album-count"></span>
                        <div><select class="form-select" aria-label="Filter album" id="album-filter" onchange="albums()">
                                <option value="A to Z">A to Z</option>
                                <option value="Z to A">Z to A</option>
                            </select></div>
                    </div>
                    <div class="list list--lg">
                        <div class="row">
                            <div class="col-xl-6" id="album-div1">
                                <!-- content -->
                            </div>
                            <div class="col-xl-6" id="album-div2">
                                <!-- content -->
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