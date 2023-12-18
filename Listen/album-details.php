<?php session_start(); ?>
<?php include 'includes/header.php'; ?>

<body onload="albumDetails()">

    <?php include 'includes/modal.php'; ?>

    <?php include 'includes/loader.php'; ?>

    <div id="wrapper">


        <?php include 'includes/sidebar.php'; ?>

        <?php include 'includes/searchbar.php'; ?>

        <main id="page_content">
            <div class="hero" style="background-image: url(images/banner/song.jpg);"></div>
            <div class="under-hero container">
                <div class="section" id="album-detail-div">
                    <!-- content -->
                </div>
                <div class="section">
                    <div class="section__head">
                        <h3 class="mb-0"><span class="text-primary" id="songs-all"></span></h3>
                    </div>
                    <div class="list">
                        <div class="row" data-collection-song-id="1">
                            <div class="col-xl-6" id="song-1">
                                <!-- content -->
                            </div>
                            <div class="col-xl-6" id="song-2">
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
        <?php include 'includes/footer.php'; ?>
</body>

</html>