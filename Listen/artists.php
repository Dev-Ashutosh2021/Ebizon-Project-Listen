<?php session_start(); ?>
<?php include 'includes/header.php'; ?>

<body onload="artists()">

    <?php include 'includes/modal.php'; ?>

    <?php include 'includes/loader.php'; ?>

    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>

        <?php include 'includes/searchbar.php'; ?>

        <main id="page_content">
            <div class="hero" style="background-image: url(images/banner/artists.jpg);"></div>
            <div class="under-hero container">
                <div class="section">
                    <div class="section__head">
                        <h3 class="mb-0">Top <span class="text-primary">Artists</span></h3>
                    </div>
                    <div class="row g-4" id="artist-div">
                        <!-- content -->
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